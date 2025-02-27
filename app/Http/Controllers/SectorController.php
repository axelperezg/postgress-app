<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SectorController extends Controller
{
    /**
     * Muestra una lista de todos los sectores.
     */
    public function index()
    {
        $sectors = Sector::all();
        return Inertia::render('Sector/Index', [
            'sectors' => $sectors
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo sector.
     */
    public function create()
    {
        return Inertia::render('Sector/Create');
    }

    /**
     * Almacena un nuevo sector en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:sectors',
            'acronym' => 'required|string|max:50|unique:sectors'
        ]);

        Sector::create($validated);

        return redirect()->route('sectors.index')
            ->with('message', 'Sector creado exitosamente');
    }

    /**
     * Muestra el formulario para editar un sector específico.
     */
    public function edit(Sector $sector)
    {
        return Inertia::render('Sector/Edit', [
            'sector' => $sector
        ]);
    }

    /**
     * Actualiza un sector específico en la base de datos.
     */
    public function update(Request $request, Sector $sector)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:sectors,name,' . $sector->id,
            'acronym' => 'required|string|max:50|unique:sectors,acronym,' . $sector->id
        ]);

        $sector->update($validated);

        return redirect()->route('sectors.index')
            ->with('message', 'Sector actualizado exitosamente');
    }

    /**
     * Elimina un sector específico de la base de datos.
     */
    public function destroy(Sector $sector)
    {
        $sector->delete();

        return redirect()->route('sectors.index')
            ->with('message', 'Sector eliminado exitosamente');
    }
}
