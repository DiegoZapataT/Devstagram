@extends('layouts.app')

@section('titulo')
    {{ $post->titulo}}
@endsection

@section('contenido')
    <div class="container mx-auto flex">
        <div class="md:w-1/2">
            <img class="rounded-xl p-1 dark:border-neutral-700 dark:bg-neutral-800"" src="{{asset('uploads' . '/' . $post -> imagen )}}" alt="Imagen del post {{ $post -> titulo }}">
            <div class="p-3 flex items-center gap-4"> 

                @auth
                    <livewire:like-post :post="$post"/>
                @endauth
            </div>
            <div>
                <p class="font-bold"><a href="{{ route('posts.index', $post->user->username) }}">{{$post -> user -> username}}</a></p>
                <p class="mt-1">
                    {{$post->descripcion}}
                </p>
                <p class="text-sm text-gray-500">
                    {{$post->created_at->diffForHumans()}}
                </p>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar Publicación" class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold cursor-pointer mt-5">
                    </form>

                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4"> Agrega un Nuevo Comentario </p>
                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('comentarios.store', ['post'=>$post, 'user'=>$user]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                añade un comentario
                            </label>
                            <textarea 
                                id="comentario" 
                                name="comentario" 
                                placeholder="Agrega un Comentario" 
                                class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror" 
                                >
                            </textarea>
                                @error('comentario')
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                                @enderror
                        </div>
                        <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                        
                    </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">{{$comentario->user->username}}</a>
                                <p>{{$comentario->comentario}}</p>
                                <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No Hay Comentarios Aún</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection