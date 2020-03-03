<?php

namespace SegWeb\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Chumper\Zipper\Facades\Zipper;
use SegWeb\Http\Controllers\Tools;
use Illuminate\Support\Facades\Storage;
use SegWeb\FileResults;
use SegWeb\File;

class GithubFilesController extends Controller
{
    private $github_files_ids = NULL;

    public function index() {
        return view('github');
    }

    public function downloadGithub(Request $request) {
        $msg = [
            'text' => 'Projeto baixado com sucesso!',
            'type' => 'success'
        ];
        if(Tools::contains("github", $request->github_link)) {
            try {
                if(Auth::check()) {
                    $user = Auth::user();
                    $user_id = $user->id;
                } else {
                    $user_id = 0;
                }
                $github_link = substr($request->github_link, -1) == '/' ? substr_replace($request->github_link ,"", -1)  : $request->github_link;
                
                $url = $github_link.'/archive/'.$request->branch.'.zip';
                $folder = 'github_uploads/';
                $now = date('ymdhis');
                $name = $folder.$now.'_'.substr($url, strrpos($url, '/') + 1);
                $put = Storage::put($name, file_get_contents($url));
                if($put) {
                    $file_location = base_path('storage/app/'.$folder.$now.'_'.$request->branch);
                    Zipper::make(base_path('storage/app/'.$name))->extractTo($file_location);
                    unlink(base_path('storage/app/'.$name));
                    
                    $file = new File();
                    $file->user_id = $user_id;
                    $file->file_path = $folder.$now.'_'.$request->branch;
                    $project_name = explode('/', $github_link);
                    $file->original_file_name = $project_name[sizeof($project_name) - 1];
                    $file->type = "Github Repository";
                    $file->save();

                    $this->analiseGithubFiles($file_location);
                    echo "<pre>";
                    print_r($this->github_files_ids);
                    echo "</pre>";

                    exit();
                    return view('analisis', compact(['file_location', 'msg']));
                } else {
                    $msg['text'] = "Erro ao efetuar download";
                    $msg['type'] = "error";
                    return view('github', compact(['msg']));
                }
            } catch (Exception $e) {
                $msg['text'] = "Erro ao realizar a operação";
                $msg['type'] = "error";
                return view('github', compact(['msg']));
            }
        } else {
            $msg['text'] = "Link inválido!";
            $msg['type'] = "error";
            return view('github', compact(['msg']));
        }
    }  

    public function analiseGithubFiles($dir) {
        $ffs = scandir($dir);
        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);

        if(!empty($ffs)) {
            $term = new TermController();
            $terms = $term->getTerm();
            foreach($ffs as $ff) {
                $full_file_path = $dir."/".$ff;
                $file_path = explode("storage/app/", $full_file_path)[1];
                if(is_dir($full_file_path)) {
                    $this->analiseGithubFiles($full_file_path);
                } else {
                    if(mime_content_type($full_file_path) == "text/x-php" || mime_content_type($full_file_path) == "application/x-php") {
                        if(Auth::check()) {
                            $user = Auth::user();
                            $user_id = $user->id;
                        } else {
                            $user_id = 0;
                        }
                        $file = new File();
                        $file->user_id = $user_id;
                        $file->file_path = $file_path;
                        $file->original_file_name = $ff;
                        $file->type = "Github File";
                        $file->save();

                        $this->github_files_ids[] = $file->id;

                        $fn = fopen($full_file_path, 'r');
                        $line_number = 1;
                        $file_content = NULL;
                        while(!feof($fn)) {
                            $file_line = fgets($fn);
                            foreach($terms as $term) {
                                if(Tools::contains($term->term, $file_line)) {
                                    $file_results = new FileResults();
                                    $file_results->file_id = $file->id;
                                    $file_results->line_number = $line_number;
                                    $file_results->term_id = $term->id;
                                    $file_results->save();
                                }
                            }
                            $file_content[$line_number] = $file_line;
                            $line_number++;
                        }
                        fclose($fn);
                    }
                }
            }
        }
    }
}
