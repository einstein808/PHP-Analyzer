<?php

namespace SegWeb\Http\Controllers;

use Chumper\Zipper\Facades\Zipper;
use Illuminate\Http\Request;
use SegWeb\File;
use SegWeb\Http\Controllers\Tools;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Auth;

class FileController extends Controller
{
    public function index() {
        $file_content = null;
        $originalname = null;
        return view('index', compact(['file_content', 'originalname']));
    }

    private function getJsonTerms() {
        $json_file = Storage::disk('local')->get('terms/terms.json');
        return json_decode($json_file, true);
    }

    public function submitFile(Request $request) {
        if($request->file('file')->getClientMimeType() == 'application/x-php') {
            $user = Auth::user();
            
            $file = new File();
            $file->user_id = $user->id;
            $file->file_path = $request->file('file')->store('uploads', 'local');
            $file->original_file_name = $request->file('file')->getClientOriginalName();
            $file->type = "File";
            $file->save();
            
            $file_content = $this->analiseFile($file->id);
            return view('index', compact(['file_content', 'file']));
        } else {
            $msg = "Tipo de arquivo não permitido! Por favor, envie um arquivo PHP.";
            return view('index', compact(['msg']));
        }
    }

    function getFileById($id) {
        $file = DB::table('files')->find($id);
        return $file;
    }

    public function analiseFile($id_file) {
        try {
            $file = $this->getFileById($id_file);
            $tools = new Tools();
            $terms = $this->getJsonTerms();
            $file_location = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($file->file_path);
            $fn = fopen("$file_location","r");
            $i = 0;
            while(!feof($fn)) {
                $file_line = fgets($fn);
                foreach($terms as $term_type_key => $term_types) {
                    foreach ($term_types as $term) {
                        if($tools->contains($term, $file_line)) {
                            $file_content[$i][$term_type_key] = $term;
                        }
                    }
                }
                $file_content[$i]['text'] = $file_line;
                $i++;
            }
            fclose($fn);
            return $file_content;
        } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
            return "Arquivo não encontrado";
        }
    }

    public function indexGithub() {
        $msg = NULL;
        return view('github', compact(['msg']));
    }

    public function downloadGithub(Request $request) {
        $tools = new Tools();
        if($tools->contains("github", $request->github_link)) {
            try {
                $github_link = substr($request->github_link, -1) == '/' ? substr_replace($request->github_link ,"", -1)  : $request->github_link;
                
                $url = $github_link.'/archive/'.$request->branch.'.zip';
                $folder = 'github_uploads/';
                $now = date('ymdhis');
                $name = $folder.$now.'-'.substr($url, strrpos($url, '/') + 1);
                $put = Storage::put($name, file_get_contents($url));
                if($put === TRUE) {
                    $file_location = base_path('storage/app/'.$folder.$now.'-'.$request->branch);
                    Zipper::make(base_path('storage/app/'.$name))->extractTo($file_location);
                    $analisis = TRUE;

                    $user = Auth::user();
                    $file = new File();
                    $file->user_id = $user->id;
                    $file->file_path = $folder.$now.'-'.$request->branch;
                    $project_name = explode('/', $github_link);
                    $file->original_file_name = $project_name[sizeof($project_name) - 1];
                    $file->type = "Github";
                    $file->save();

                    return view('analisis', compact(['analisis', 'file_location']));
                } else {
                    $msg = "Erro ao realizar a operação";
                    return view('github', compact(['msg']));
                }
            } catch (Exception $msg) {
                return view('github', compact(['msg']));
            }
        } else {
            $msg = "Link inválido!";
            return view('github', compact(['msg']));
        }
    }   

    public function load_results(Request $request) {
        echo "aqui";
    }

    public function indexYourFiles() {
        $files = $this->getAllByUserId();
        return view('yourfiles', compact('files'));
    }

    public function getAllByUserId() {
        $user = Auth::user();
        return File::where('user_id', $user->id)->get();
    }
}