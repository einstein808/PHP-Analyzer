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
        $url = $request->github_link.'/archive/'.$request->branch.'.zip';
        $contents = file_get_contents($url);
        $folder = 'github_uploads/';
        $now = date('ymdhis');
        $name = $folder.$now.'-'.substr($url, strrpos($url, '/') + 1);
        $put = Storage::put($name, $contents);
        if($put === TRUE) {
            $file_location = base_path('storage/app/'.$folder.$now);
            Zipper::make(base_path('storage/app/'.$name))->extractTo($file_location);
            $analisis = TRUE;
            return view('analisis', compact(['analisis', 'file_location']));
        } else {
            $msg = "Erro ao realizar a operação";
            return view('github', compact(['msg']));
        }
    }   

    // public function listFolderFiles($path) {

    //     // $diretorio = dir($path);
        
    //     // echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";
    //     // while($arquivo = $diretorio -> read()) {

    //     // echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
    //     // }
    //     // $diretorio -> close();




    //     $diretorio = dir($path);
        
        
    //     $i = 0;
    //     while($arquivo = $diretorio -> read()) {
    //         $tools = new Tools();
    //         if(is_dir($path.$arquivo)) {
    //         // if(!$tools->contains('.', $arquivo)) {
    //             // echo "é diretorio <br>";
    //             $files['directory'][$i] = $path.$arquivo;
    //             $this->listFolderFiles($path.$arquivo);
    //         } else {
    //             // echo "é arquivo <br>";
    //             $files['file'][$i] = $path.$arquivo;
    //         }    
    //         $i++;
    //     // echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
    //     }
    //     $diretorio -> close();


    //     // $ffs = scandir($dir);
    //     // unset($ffs[array_search('.', $ffs, true)]);
    //     // unset($ffs[array_search('..', $ffs, true)]);
    //     // $files['directory'] = $dir;
    //     // if (count($ffs) < 1) return;

        
    //     // foreach($ffs as $key => $ff){
    //     //     if(is_dir($dir.'/'.$ff)) {
    //     //         echo "é diretorio <br>";
    //     //         $files['directory'][$key] = $dir.'/'.$ff;
    //     //         $this->listFolderFiles($dir.'/'.$ff);
    //     //     } else {
    //     //         echo "é arquivo <br>";
    //     //         $files['file'][$key] = $ff;
    //     //     }
    //     //     // echo '<li><a href='.$dir.'/'.$ff.'>'.$ff.'</a>';
    //     //     // if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
    //     //     // echo '</li>';
    //     // }
    //     // echo "<pre>";
    //     // print_r($files);
    //     // echo "</pre>";
    //     // // echo '</ul>';
    //     return $files;
    // }
}