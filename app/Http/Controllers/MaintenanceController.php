<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanceRequest;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Afficher la liste des maintenances.
     */
    public function index()
    {
        $maintenances = Maintenance::all();
        return view('maintenances.index', compact('maintenances'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        return view('maintenances.create');
    }

    /**
     * Enregistrer une nouvelle maintenance.
     */
    public function store(MaintenanceRequest $request)
    {
        // Les données sont automatiquement validées par MaintenanceRequest
        Maintenance::create($request->validated());

        return redirect()->route('maintenances.index')->with('success', 'Maintenance créée avec succès.');
    }

    /**
     * Afficher une maintenance spécifique.
     */
    public function show(Maintenance $maintenance)
    {
        return view('maintenances.show', compact('maintenance'));
    }

    /**
     * Afficher le formulaire d'édition d'une maintenance.
     */
    public function edit(Maintenance $maintenance)
    {
        return view('maintenances.edit', compact('maintenance'));
    }

    /**
     * Mettre à jour une maintenance.
     */
    public function update(MaintenanceRequest $request, Maintenance $maintenance)
    {
        // Les données sont automatiquement validées par MaintenanceRequest
        $maintenance->update($request->validated());

        return redirect()->route('maintenances.index')->with('success', 'Maintenance mise à jour avec succès.');
    }

    /**
     * Supprimer une maintenance.
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();

        return redirect()->route('maintenances.index')->with('success', 'Maintenance supprimée avec succès.');
    }
}
