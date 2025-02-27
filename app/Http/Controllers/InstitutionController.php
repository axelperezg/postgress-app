<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Sector;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InstitutionController extends Controller
{
    /**
     * Muestra una lista de todas las instituciones.
     */
    public function index()
    {
        $institutions = Institution::with('sector')->get();
        return Inertia::render('Institution/Index', [
            'institutions' => $institutions
        ]);
    }

    /**
     * Muestra el formulario para crear una nueva institución.
     */
    public function create()
    {
        $sectors = Sector::all();
        return Inertia::render('Institution/Create', [
            'sectors' => $sectors
        ]);
    }

    /**
     * Almacena una nueva institución en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sector_id' => 'required|exists:sectors,id',
            'name' => 'required|string|max:255|unique:institutions',
            'code' => 'required|string|max:255|unique:institutions',
            'responsableInstitution' => 'nullable|string|max:255',
            'cargoInstitution' => 'nullable|string|max:255',
            'direccionEntrega' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'map_google' => 'nullable|string'
        ]);

        Institution::create($validated);

        return redirect()->route('institutions.index')
            ->with('message', 'Institución creada exitosamente');
    }

    /**
     * Muestra el formulario para editar una institución específica.
     */
    public function edit(Institution $institution)
    {
        $sectors = Sector::all();
        return Inertia::render('Institution/Edit', [
            'institution' => $institution->load('sector'),
            'sectors' => $sectors
        ]);
    }

    /**
     * Actualiza una institución específica en la base de datos.
     */
    public function update(Request $request, Institution $institution)
    {
        $validated = $request->validate([
            'sector_id' => 'required|exists:sectors,id',
            'name' => 'required|string|max:255|unique:institutions,name,' . $institution->id,
            'code' => 'required|string|max:255|unique:institutions,code,' . $institution->id,
            'responsableInstitution' => 'nullable|string|max:255',
            'cargoInstitution' => 'nullable|string|max:255',
            'direccionEntrega' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'map_google' => 'nullable|string'
        ]);

        $institution->update($validated);

        return redirect()->route('institutions.index')
            ->with('message', 'Institución actualizada exitosamente');
    }

    /**
     * Elimina una institución específica de la base de datos.
     */
    public function destroy(Institution $institution)
    {
        $institution->delete();

        return redirect()->route('institutions.index')
            ->with('message', 'Institución eliminada exitosamente');
    }
} 