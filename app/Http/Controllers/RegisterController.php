<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index () {
        return view('auth.register'); 
    } 

    public function store(Request $request){
        

        //dd($request); //-> Nos permite observar todos los valores que se esten enviando a traves del formulario
        //dd($request->get('username')); //get('<etiqueta de name de los inputs del formulario>') -> Nos permite ver de manera individual los valores enviados

        //MODIFICAR REQUEST
        $request -> request -> add(['username' => Str::slug($request -> username)]);

        //VALIDACION
        $this -> validate($request, [
            'name' => 'required|min:4',
            'username' => 'required|unique:users|min:4|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|between: 5,30',
        ]);

        User::create([
            'name' => $request -> name,
            'username' => $request -> username,
            'email' => $request -> email,
            'password' => Hash::make($request -> password),
        ]);

        //AUTENTICAR USUARIO
        //auth() -> attempt([
        //    'email' => $request -> email,
        //    'password' => $request -> password
        //]);

        //OTRA FORMA DE AUTENTICAR
        auth()-> attempt($request->only('email','password'));

        //REDIRECCIONAR
        return redirect() -> route('posts.index',['user'=>auth()->user()->username]);
    }
}
