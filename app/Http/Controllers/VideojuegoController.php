<?php

namespace App\Http\Controllers;

use App\Mail\NuevoVideojuego;
use App\Models\Videojuego;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VideojuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videojuegos = Videojuego::paginate(10);
        return view('videojuegos.index', compact('videojuegos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videojuegos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida y guarda el videojuego
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'caratula' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Imagen opcional, 2 MB máximo
        ]);

        // Subir carátula si se proporciona
        $caratulaPath = null;
        if ($request->hasFile('caratula')) {
            $caratulaPath = $request->file('caratula')->store('caratulas', 'public');
        }

        $videojuego = auth()->user()->videojuegos()->create($validated);

        $videojuego->titulo = $request->titulo;
        $videojuego->descripcion = $request->descripcion;
        $videojuego->caratula = basename($caratulaPath);
        $videojuego->user_id = auth()->id();
        $videojuego->save();


        // Lógica para enviar correo al admin
        Mail::to('ppedrolo957@gmail.com')->send(new NuevoVideojuego($videojuego));

        return redirect()->route('videojuegos.index')->with('success', 'Videojuego creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $videojuego = Videojuego::with('comentarios.user')->findOrFail($id);
        return view('videojuegos.show', compact('videojuego'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videojuego $videojuego)
    {
        if (auth()->user()->id !== $videojuego->user_id && !auth()->user()->is_admin) {
            abort(403, 'No tienes permiso para editar este videojuego.');
        }

        return view('videojuegos.edit', compact('videojuego'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videojuego $videojuego)
    {

        if (auth()->user()->id !== $videojuego->user_id && !auth()->user()->is_admin) {
            abort(403, 'No tienes permiso para editar este videojuego.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'caratula' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Actualizar título y descripción
        $videojuego->titulo = $request->titulo;
        $videojuego->descripcion = $request->descripcion;

        // Manejar la nueva carátula si se subió
        if ($request->hasFile('caratula')) {
            // Eliminar la carátula anterior si existe
            if ($videojuego->caratula) {
                Storage::disk('public')->delete($videojuego->caratula);
            }

            // Guardar la nueva carátula
            $videojuego->caratula = $request->file('caratula')->store('caratulas', 'public');
        }

        // Guardar cambios
        $videojuego->save();
        return redirect()->route('videojuegos.index')->with('success', 'Videojuego actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $videojuego = Videojuego::findOrFail($id);
        $videojuego->delete();

        return redirect()->route('videojuegos.index')->with('success', 'Videojuego eliminado correctamente.');
    }
}
