<?php

namespace SegWeb\Http\Controllers;

use Illuminate\Http\Request;
use SegWeb\File;
use SegWeb\Http\Controllers\Tools;
use Illuminate\Support\Facades\Storage;
use App;

class FileController extends Controller
{
    public function index() {
        $file_content = null;
        $originalname = null;
        return view('index', compact(['file_content', 'originalname']));
    }

    private function getJsonTerms() {
        $json_file = Storage::disk('public')->get('terms/terms.json');
        return json_decode($json_file, true);
    }
    
    public function submitFile(Request $request) {
        $file = new File();
        $path = $request->file('file')->store('uploads', 'public');
        $originalname = $request->file('file')->getClientOriginalName();
        $file->arquivo = $path;
        $file->nome_original = $originalname;
        $file->save();

        $tools = new Tools();
        try {
            $terms = $this->getJsonTerms();
            $file_location = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($file->arquivo);
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
            // excluir arquivo
        } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
            $file_content = "Arquivo não encontrado";
        }
        
        return view('index', compact(['file_content', 'originalname']));
    }
}
