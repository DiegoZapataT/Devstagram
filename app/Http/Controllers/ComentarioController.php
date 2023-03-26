<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //
    public function store(Request $request, User $user, Post $post){
        //VALIDAR

        //dd($post->id);

        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        //ALMACENAR

        Comentario::create([
            'user_id' => auth() -> user() ->id,
            'post_id' => $post -> id,
            'comentario' => $request -> comentario
        ]);

        //GUARDAR MENSAJE
        return back() -> with('mensaje','Comentario realizado correctamente');
    }
}
