<?php

namespace SegWeb\Http\Controllers;

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

    // public function store(Request $request) {
    //     $file = new File();
        
    //     $path = $request->file('file')->store('uploads', 'public');
    //     $originalname = $request->file('file')->getClientOriginalName();
    //     $file->arquivo = $path;
    //     $file->nome_original = $originalname;
    //     $file->save();

    //     $tools = new Tools();
    //     try {
    //         $file_location = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($file->arquivo);
    //         // $fn = fopen('/home/jonas/Documentos/biblioteca/db/Conexao.php',"r");
    //         $fn = fopen("$file_location","r");
    //         $i = 0;
    //         while(!feof($fn))  {
    //             $result = fgets($fn);
    //             if($tools->contains('pdo', $result)) {
    //                 $file_content[$i]['warning'] = true;
    //             }
    //             if($tools->contains('db', $result)) {
    //                 $file_content[$i]['danger'] = true;
    //             }
    //             $file_content[$i]['text'] = $result;
    //             $i++;
    //         }
    //         fclose($fn);
    //     } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
    //         $file_content = "Arquivo não encontrado";
    //     }
        
    //     return view('index', compact(['file_content', 'originalname']));
    // }
    
    public function store(Request $request) {
        $file = new File();
        
        $path = $request->file('file')->store('uploads', 'public');
        $originalname = $request->file('file')->getClientOriginalName();
        $file->arquivo = $path;
        $file->nome_original = $originalname;
        $file->save();

        $tools = new Tools();
        try {
            $file_location = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($file->arquivo);
            // $fn = fopen('/home/jonas/Documentos/biblioteca/db/Conexao.php',"r");
            $fn = fopen("$file_location","r");
            $i = 0;
            while(!feof($fn))  {
                $result = fgets($fn);
                if($tools->contains('pdo', $result)) {
                    $file_content[$i]['warning'] = true;
                }
                if($tools->contains('db', $result)) {
                    $file_content[$i]['danger'] = true;
                }
                $file_content[$i]['text'] = $result;
                $i++;
            }
            fclose($fn);
        } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
            $file_content = "Arquivo não encontrado";
        }
        
        return view('index', compact(['file_content', 'originalname']));
    }

}
