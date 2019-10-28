<?php

namespace SegWeb\Http\Controllers;

use Chumper\Zipper\Facades\Zipper;
use Illuminate\Http\Request;
use SegWeb\File;
use SegWeb\Http\Controllers\Tools;
use Illuminate\Support\Facades\Storage;

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
        $file = new File();
        $path = $request->file('file')->store('uploads', 'local');
        $originalname = $request->file('file')->getClientOriginalName();
        $file->arquivo = $path;
        $file->nome_original = $originalname;
        $file->save();

        $tools = new Tools();
        try {
            $terms = $this->getJsonTerms();
            $file_location = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($file->arquivo);
            $fn = fopen("$file_location","r");
            $i = 0;
            while(!feof($fn))  {
                
                $file_line = fgets($fn);
                foreach($terms as $term_type_key => $term_types) {
                    foreach ($term_types as $term_key => $term) {
                        if($tools->contains($term, $file_line)) {
                            $file_content[$i][$term_type_key] = $term;
                        }
                    }
                }
                $file_content[$i]['text'] = $file_line;
                $i++;
            }
            fclose($fn);
        } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
            $file_content = "Arquivo não encontrado";
        }
        
        return view('index', compact(['file_content', 'originalname']));
    }

    public function indexGithub() {
        $msg = NULL;
        return view('github', compact(['msg']));
    }

    public function downloadGithub(Request $request) {
        try {
            substr($request->github_link, -1) == '/' ? $github_link = substr_replace($request->github_link ,"", -1)  : $github_link = $request->github_link;
            $url = $github_link.'/archive/'.$request->branch.'.zip';
            $folder = 'github_uploads/';
            $now = date('ymdhis');
            $name = $folder.$now.'-'.substr($url, strrpos($url, '/') + 1);
            $put = Storage::put($name, file_get_contents($url));
            if($put === TRUE) {
                $file_location = base_path('storage/app/'.$folder.$now);
                Zipper::make(base_path('storage/app/'.$name))->extractTo($file_location);
                $analisis = TRUE;
                return view('analisis', compact(['analisis', 'file_location']));
            } else {
                $msg = "Erro ao realizar a operação";
                return view('github', compact(['msg']));
            }
        } catch (Exception $e) {
            return view('github', compact([$e]));
        }
    }   


    public function load_results(Request $request) {
        echo "aqui";
    }


}