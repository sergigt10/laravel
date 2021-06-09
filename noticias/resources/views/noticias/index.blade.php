@extends('layouts.app')

@section('botones')
    @include('ui.navegacion')
@endsection

@section('content')

    <h2 class="text-center mb-5">Administrar tus noticias</h2>

    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Título</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach($noticias as $noticia)
                    <tr>
                        <td>{{ $noticia->titulo }}</td>
                        <td>
                            <eliminar-noticia
                                noticia-id={{$noticia->id}}
                            ></eliminar-noticia>
                            <a href="{{ route('noticias.edit', ['noticia' => $noticia->id]) }}" class="btn btn-dark d-block mb-2">Editar</a>
                            <a href="{{ route('noticias.show', ['noticia' => $noticia->id]) }}" class="btn btn-success d-block mb-2">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="col-12 mt-4 justify-content-center d-flex">
            {{ $noticias->links() }}
        </div>

    </div>

@endsection