@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha512-494Ejp/5WyoRNfh+nPLhSCQPHhcsbA5PoIGv2/FuEo+QLfW+L7JQGPdh8Qy2ZOmkF27pyYlALrxteMiKau1tyw==" crossorigin="anonymous" />
@endsection

@section('botones')

    <a href="{{ route('noticias.index') }}" class="btn btn-primary mr-2 text-white">
        <svg class="icono" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
        </svg>
        Volver
    </a>

@endsection

@section('content')

    <h2 class="text-center mb-5">Editar noticia: {{ $noticia->titulo }}</h2>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('noticias.update', ['noticia' => $noticia->id]) }}" enctype="multipart/form-data" novalidate>
                @csrf

                @method('PUT')
                <div class="form-group">
                    <label for="titulo">Título noticia</label>

                    <input 
                        type="text"
                        name="titulo"
                        class="form-control @error('titulo') is-invalid @enderror "
                        id="titulo"
                        placeholder="Titulo noticia"
                        value="{{ $noticia->titulo }}"
                    />

                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group mt-3">
                    <label for="descripcion">
                        Descripción
                    </label>
                    <input id="descripcion" type="hidden" name="descripcion" value="{{ $noticia->descripcion }}">
                    <trix-editor 
                        class="form-control @error('descripcion') is-invalid @enderror "
                        input="descripcion">
                    </trix-editor>

                    @error('descripcion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="ingredientes">
                        Elige la imagen
                    </label>

                    <input 
                        id="imagen" 
                        type="file" 
                        class="form-control @error('imagen') is-invalid @enderror" 
                        name="imagen"
                    >

                    <div class="mt-4">
                        <p>Imagen actual:</p>

                        <img src="/storage/{{$noticia->imagen}}" style="width: 300px">
                    </div>

                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Actualizar noticia">
                </div>

            </form>
        </div>
    </div>

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha512-wEfICgx3CX6pCmTy6go+PmYVKDdi4KHhKKz5Xx/boKOZOtG7+rrm2fP7RUR2o4m/EbPdwbKWnP05dvj4uzoclA==" crossorigin="anonymous" defer></script>
@endsection

@endsection