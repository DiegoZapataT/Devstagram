<div>
    @if($posts->count()) 
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
        @foreach($posts as $post)
            <div>
                <a href="{{ route('posts.show', ['post'=>$post, 'user'=>$post->user]) }}">
                    <img src="{{asset('uploads') . '/' . $post -> imagen }}" alt="Imagen del post {{ $post -> titulo }}">
                </a>
                <a href="{{ route('posts.index', $post->user->username) }}" class="font-bold">Autor: {{$post->user->username}}</a>
            </div>
        @endforeach
    </div>

    <div class="my-10">
        {{ $posts-> links('pagination::tailwind') }}
    </div>
@else
    <p class="text-center">Sigue a Alguien para ver sus Posts</p>
@endif
</div>