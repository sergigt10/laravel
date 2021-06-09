@extends('layouts.app')

@section('content')

    <article class="contenido-noticia">
        <h1 class="text-center mb-4">{{ $noticia->titulo }}</h1>

        <div class="imagen-noticia">
            <img src="/storage/{{$noticia->imagen}}" class="w-100">
        </div>

        <div class="receta-meta mt-2">

            <div class="descripcion">
                <h2 class="my-3 text-primary">Descripción</h2>
                {!! $noticia->descripcion !!}
            </div>

        </div>

    </article>
@endsection