<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VideojuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videojuegos = Videojuego::all();
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
            'caratula' => 'nullable|image|max:2048', // Imagen opcional, 2 MB máximo
        ]);

        // Subir carátula si se proporciona
        if ($request->hasFile('caratula')) {
            $validated['caratula'] = $request->file('caratula')->store('caratulas', 'public');
        }

        $videojuego = auth()->user()->videojuegos()->create($validated);

        // Lógica para enviar correo al admin (se detalla más abajo)
        Mail::to('admin@example.com')->send(new \App\Mail\NuevoVideojuego($videojuego));

        return redirect()->route('videojuegos.index')->with('success', 'Videojuego creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $videojuego = Videojuego::with('comentarios.usuario')->findOrFail($id);
        return view('videojuegos.show', compact('videojuego'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videojuego $videojuego)
    {
        // Formulario de edición
        $this->authorize('update', $videojuego);
        return view('videojuegos.edit', compact('videojuego'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videojuego $videojuego)
    {
        // Valida y actualiza el videojuego
        $this->authorize('update', $videojuego);
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'caratula' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('caratula')) {
            $validated['caratula'] = $request->file('caratula')->store('caratulas', 'public');
        }

        $videojuego->update($validated);
        return redirect()->route('videojuegos.index')->with('success', 'Videojuego actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $videojuego = Videojuego::findOrFail($id);
        $videojuego->delete();

        return redirect()->route('videojuegos.index')->with('success', 'Videojuego eliminado correctamente.');
    }
}
