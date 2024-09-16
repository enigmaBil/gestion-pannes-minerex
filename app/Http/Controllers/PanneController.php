<?php

namespace App\Http\Controllers;

use App\Models\Panne;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Str;

class PanneController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.dashboard.pannes.create', compact('users'));
    }

    public function createPanne(Request $request)
    {
        try {
            // Valider les données d'entrée
            $validated = $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'type' => 'required|string',
                'user_id' => 'required|exists:users,id', // vérifier si l'utilisateur existe
            ]);

            // Créer une nouvelle panne
            Panne::create($validated);

            // Log la création réussie
            Log::info('Panne created successfully.', $validated);

            return redirect()->route('panne.create')->with('success', 'La Panne a été créée avec succès.');
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            // Log les erreurs de validation
            Log::error('Validation failed for creating panne.', [
                'errors' => $e->errors(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec les erreurs
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        catch (\Exception $e) {
            // Log toutes les autres exceptions
            Log::error('Failed to create panne.', [
                'message' => $e->getMessage(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec un message d'erreur générique
            return redirect()->back()->with('error', 'Failed to create panne. Please try again.');
        }
    }
    //get list view
    public function listview()
    {
        $pannes = Panne::all();
        return view('admin.dashboard.pannes.list', compact('pannes'));
    }
}
