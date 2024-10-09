<?php

namespace App\Http\Controllers;

use App\Models\Panne;
use App\Models\User;
use App\Notifications\PanneAssigneeNotification;
use App\Notifications\PanneSignalee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Str;

class PanneController extends Controller
{
//    public function __construct()
//    {
//        // Appliquer le middleware pour contrôler l'accès basé sur les rôles
//        $this->middleware(['role:Admin|Lead_Technician|Technician'])->except(['index', 'createPanne', 'listview']);
//        $this->middleware(['role:Admin|Lead_Technician'])->only(['edit', 'update', 'destroy']);
//        $this->middleware(['role:Admin|Lead_Technician|Technician'])->only(['show']);
//    }
    public function index()
    {
        $users = User::all();
        return view('admin.dashboard.pannes.create', compact('users'));
    }

    private function generateCode(): string {
        $longueur = 6; // 6 caractères après le #
        $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '#';

        // Générer les 6 caractères aléatoires
        for ($i = 0; $i < $longueur; $i++) {
            $code .= $caracteres[random_int(0, strlen($caracteres) - 1)];
        }

        // Ajouter la date du jour au format YYYYMMDD avec un trait d'union
        $date = strtoupper(date('Ymd'));

        // Retourner le code généré en majuscules suivi d'un trait d'union et de la date
        return $code . '-' . $date;
    }



    public function createPanne(Request $request)
    {
        DB::beginTransaction();
        try {
            // Valider les données d'entrée
            $validated = $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'type' => 'required|string',
                'user_id' => 'required|exists:users,id', // vérifier si l'utilisateur existe
            ]);

            $validated['code' ] = $this->generateCode();
//            dd($validated);

            // Créer une nouvelle panne
            $panne = Panne::create($validated);
            \auth()->user()->notify(new PanneSignalee($panne, $request->all()));
            DB::commit();
            // Log la création réussie
            Log::info('Panne created successfully.', $validated);
            alert()->success('Panne créée', 'La panne a été ajouté avec succès.');

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

    public function assignTechnician(Request $request, Panne $panne)
    {
        DB::beginTransaction();
        try {
            // Valider les données
            $request->validate([
                'user_id' => 'required|exists:users,id',
            ]);

            // Assigner le technicien
            $technician = User::findOrFail($request->user_id);
//            $panne->user_id = $technician->id;
            $panne->status = 'en attente'; // Vous pouvez ajuster le statut selon votre logique
            $panne->save();

            // Envoyer une notification au technicien
            $technician->notify(new PanneAssigneeNotification($panne));
            DB::commit();
            alert()->success('Panne assignée','La Panne a été assignée avec succès à '. $technician->name . '.');

            return redirect()->route('notif.index')->with('success', 'Panne assignée avec succès à ' . $technician->name . '.');

        }catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            // Log les erreurs de validation
            Log::error('Validation failed for creating panne.', [
                'errors' => $e->errors(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec les erreurs
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        catch (\Exception $e) {
            DB::rollBack();
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
        // Super_Admin et Lead_Technician voient toutes les pannes
        if (Auth::user()->hasRole('Admin')||Auth::user()->hasRole('Lead_Technician')) {
            $pannes = Panne::all();
        }
        // Technician voit uniquement les pannes qui lui sont assignées
        elseif (Auth::user()->hasRole('Technician')) {
            $pannes = Panne::where('user_id', Auth::id())->get();
        }
        // Employee ne voit pas ce menu (si applicable)
        else {
            $pannes = collect(); // Vide
        }
        return view('admin.dashboard.pannes.list', compact('pannes'));
    }

    // Afficher une panne spécifique
    public function show($id)
    {
        $panne = Panne::findOrFail($id);

        return view('admin.dashboard.pannes.show', compact('panne'));
    }


    // Éditer une panne
    public function edit($id)
    {
        $panne = Panne::findOrFail($id);
        $users = User::all();

        return view('admin.dashboard.pannes.edit', compact('panne', 'users'));
    }

    // Mettre à jour une panne
    public function update(Request $request, $id)
    {
        $panne = Panne::findOrFail($id);

//        // Vérifier les permissions
//        if (!Auth::user()->hasRole('Admin')||!Auth::user()->hasRole('Lead_Technician')) {
//            abort(403, 'Unauthorized action.');
//        }

        try {
            // Valider les données d'entrée
            $validated = $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'type' => 'required|string',
                'user_id' => 'required|exists:users,id',
            ]);

            // Mettre à jour la panne
            $panne->update($validated);

            // Log la mise à jour réussie
            Log::info('Panne updated successfully.', $validated);
            alert()->success('Mise à jour', 'La panne a été mise à jour avec succès.');
            return redirect()->route('list.panne')->with('success', 'La Panne a été mise à jour avec succès.');
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            // Log les erreurs de validation
            Log::error('Validation failed for updating panne.', [
                'errors' => $e->errors(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec les erreurs
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        catch (\Exception $e) {
            // Log toutes les autres exceptions
            Log::error('Failed to update panne.', [
                'message' => $e->getMessage(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec un message d'erreur générique
            return redirect()->back()->with('error', 'Failed to update panne. Please try again.');
        }
    }

    // Supprimer une panne
    public function destroy($id)
    {
        $panne = Panne::findOrFail($id);

//        // Vérifier les permissions
//        if (!Auth::user()->hasRole('Admin')||!Auth::user()->hasRole('Lead_Technician')) {
//            abort(403, 'Unauthorized action.');
//        }

        try {
            $panne->delete();

            // Log la suppression réussie
            Log::info('Panne deleted successfully.', ['panne_id' => $id]);
            alert()->success('suppression', 'La panne a été supprimée avec succès.');
            return redirect()->route('panne.listview')->with('success', 'La Panne a été supprimée avec succès.');
        }
        catch (\Exception $e) {
            // Log toutes les exceptions
            Log::error('Failed to delete panne.', [
                'message' => $e->getMessage(),
                'panne_id' => $id,
            ]);

            return redirect()->back()->with('error', 'Failed to delete panne. Please try again.');
        }
    }
}
