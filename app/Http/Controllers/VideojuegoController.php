<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use Illuminate\Http\Request;

class VideojuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videojuegos = Videojuego::with('user')->get();
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
        \Mail::to('admin@example.com')->send(new \App\Mail\NuevoVideojuego($videojuego));

        return redirect()->route('videojuegos.index')->with('success', 'Videojuego creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Videojuego $videojuego)
    {
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
    public function destroy(Videojuego $videojuego)
    {
        $this->authorize('delete', $videojuego);
        $videojuego->delete();
        return redirect()->route('videojuegos.index')->with('success', 'Videojuego eliminado.');
    }
}
