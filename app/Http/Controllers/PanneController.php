<?php

namespace App\Http\Controllers;

use App\Models\Panne;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Str;

class PanneController extends Controller
{
    //exemple of create a simple user for test
    // public function createUser(Request $request)
    // {
    //     // Valider les données d'entrée
    //     $validated = $request->validate([
    //         'first_name' => 'required|string',
    //         'last_name' => 'required|string',
    //         'email' => 'required|email|unique:users,email', // vérifier si l'email est unique
    //         'phone' => 'required|string',
    //         'departement' => 'required|string',
    //     ]);

    //     // Générer un mot de passe aléatoire
    //     $password = Str::random(8);

    //     try {
    //         // Créer l'utilisateur
    //         $user = User::create([
    //             'first_name' => $validated['first_name'],
    //             'last_name' => $validated['last_name'],
    //             'email' => $validated['email'],
    //             'phone' => $validated['phone'],
    //             'departement' => $validated['departement'],
    //             'password' => $password, // Hacher le mot de passe
    //         ]);

    //         // Réponse JSON en cas de succès
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'User created successfully.',
    //             'data' => [
    //                 'first_name' => $user->first_name,
    //                 'last_name' => $user->last_name,
    //                 'email' => $user->email,
    //                 'departement' => $user->departement,
    //             ],
    //             'password' => $password // Vous pouvez retourner le mot de passe temporaire si nécessaire
    //         ], 201);
    //     } catch (\Exception $e) {
    //         // Réponse JSON en cas d'erreur
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'User creation failed.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
    //get create view
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
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log les erreurs de validation
            Log::error('Validation failed for creating panne.', [
                'errors' => $e->errors(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec les erreurs
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
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
