<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostControlador extends Controller
{
   
    // retorna todos os posts com suas imagens
    public function index()
    {
        $posts = Post::all();
        return view ('index', compact('posts'));
    }

    // armazena um novo post com sua imagem
    public function store(Request $request)
    {
        /* 
        'arquivo' = nome do campo retornado da view
        'imagens' = diretório criado em 'storage\app\public\imagens'
        'public'  = tipo de 'disco' de armazenamento a ser usado.    
         Obs.: Por default, o Laravel usa o disco 'local'. 
               Ambos os discos estão definidos em 'config\filesystems.php'. 
        */

        // armazena o arquivo no diretório 'storage\app\public\imagens' e obtem o caminho
        $path_arquivo = $request->file('arquivo')->store('imagens','public');  

        $post = new Post();
        $post->email = $request->input('email');
        $post->mensagem = $request->input('mensagem');
        $post->arquivo = $path_arquivo;  //armazena o caminho do arquivo
        $post->save();

        return redirect('/');
    }

    // deleta um post da base e sua imagem do storage
    public function destroy($id)
    {
        $post = Post::find($id);

        if(isset($post)){
            $path_arquivo = $post->arquivo;    //obtém o nome do arquivo
            
            Storage::disk('public')->delete($path_arquivo);  // apaga o arquivo do storage informando o disco
            
            $post->delete();  // apaga da base
        }
        return redirect('/');
    }

    // faz o download da imagem de um post
    public function download($id){
        $post = Post::find($id);

        if(isset($post)){
            // obtém o caminho completo do arquivo
            $path_arquivo = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($post->arquivo);
            
            // faz o download e retorna o arquivo
            return response()->download($path_arquivo);
        }

        return redirect('/');
    }
}
