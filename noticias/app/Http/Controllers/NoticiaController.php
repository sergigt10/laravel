<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class NoticiaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = auth()->user();

        // Noticas con paginación
        $noticias = Noticia::where('user_id', $usuario->id)->paginate(10);

        return view('noticias.index')
            ->with('noticias', $noticias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('noticias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required|image'
        ]);

        $ruta_imagen = $request['imagen']->store('img-noticias', 'public');

        $img = Image::make( public_path("storage/{$ruta_imagen}") )->fit(1200, 550);
        $img->save();

        // almacenar en la bd con modelo
        auth()->user()->noticias()->create([
            'titulo' => $data['titulo'],
            'descripcion' => $data['descripcion'],
            'imagen' => $ruta_imagen,
        ]);

        // Redireccionar
        return redirect()->action('NoticiaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function show(Noticia $noticia)
    {
        return view('noticias.show', compact('noticia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function edit(Noticia $noticia)
    {
        // Revisar el policy
        $this->authorize('view', $noticia);

        return view('noticias.edit', compact('noticia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Noticia $noticia)
    {
        // Revisar el policy
        $this->authorize('update', $noticia);

        // Validación
        $data = $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
        ]);

        // Asignar los valores
        $noticia->titulo = $data['titulo'];
        $noticia->descripcion = $data['descripcion'];

        // Si el usuario sube una nueva imagen
        if(request('imagen')) {
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

            $img = Image::make( public_path("storage/{$ruta_imagen}") )->fit(1200, 550);
            $img->save();

            // Asignar al objeto
            $noticia->imagen = $ruta_imagen;
        }

        $noticia->save();

        // Redireccionar
        return redirect()->action('NoticiaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Noticia $noticia)
    {
        // Ejecutar el policy
        $this->authorize('delete', $noticia);

        // Eliminar la receta
        $noticia->delete();

        return redirect()->action('NoticiaController@index');
    }
}
