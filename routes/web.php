<?php

use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class) -> name('home'); 

// name -> Nos permite renombrar o asignar un nombre a la url, como si fuera una variable, pero no afectara a la url web mostrada en el navegador
//Siemre se debe crear en este orden un controlador -> luego la vista -> y luego setear el modelo en web.php

//RUTAS PARA LA PAGINA
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index']) -> name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store']) -> name('logout');

//RUTAS PARA EL PERFIL
Route::get('/editar-perfil', [PerfilController::class, 'index']) -> name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store']) -> name('perfil.store');

Route::get('/{user:username}', [PostController::class, 'index']) -> name('posts.index');
Route::get('/posts/create', [PostController::class, 'create']) -> name('posts.create');
Route::post('/posts', [PostController::class, 'store']) -> name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show']) -> name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy']) -> name('posts.destroy');
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store']) -> name('comentarios.store');

Route::post('/imagenes', [ImagenController::class, 'store']) -> name('imagenes.store');

//LIKE A LAS FOTOS
Route::post('/posts/{post}/likes',[LikeController::class, 'store']) -> name('posts.likes.store');
Route::delete('/posts/{post}/likes',[LikeController::class, 'destroy']) -> name('posts.likes.destroy');

//SIGUIENDO USUARIOS
Route::post('/{user:username}/follow', [FollowerController::class, 'store']) -> name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy']) -> name('users.unfollow');

//BUSQUEDA