<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Technician;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {

        return view('admin.dashboard.admin');
    }

    public function  create()
    {
        $users = User::all();

        return view('admin.dashboard.users.create', compact('users'));
    }
    public function createLeadTech()
    {
        $users = User::all();

        return view('admin.dashboard.users.create_leadtech', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            // Valider les données d'entrée
            $technicien = $request->validate([
                'user_id' => 'required|exists:users,id',// vérifier si l'utilisateur existe
                'speciality' => 'required|string',
                'grade' => 'required|string',
            ]);

            // Créer un nouveau technicien
            $technicien = Technician::create($technicien);
            //dd($technicien);
            // Associe le rôle "Technician" à cet employe
            $technicianRole = Role::where('name', 'Technician')->first();
            if ($technicianRole){
                $technicien->roles()->attach($technicianRole->id);// Attach l'ID du rôle à l'utilisateur
            }else{
                // Gérer l'absence du rôle "Technician"
                throw new Exception('Le rôle Technician est introuvable.');
            }

            // Log la création réussie
            Log::info('Technicien cree avec succes.', $technicien);

            return redirect()->route('admin.users')->with('success', 'Le technicien a été créé avec succès.');

        }
        catch (\Illuminate\Validation\ValidationException $e){
            // Log les erreurs de validation
            Log::error('Echec de la validation du technicien.', [
                'errors' => $e->errors(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec les erreurs
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        catch (\Exception $e){
            // Log toutes les autres exceptions
            Log::error('Echec de creation du technicien.', [
                'message' => $e->getMessage(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec un message d'erreur générique
            return redirect()->back()->with('error', 'Echec de creation du technicien. Reessayer plus tard.');
        }
    }

    public function getAllUsers()
    {
        $users = User::all();
        return view('admin.dashboard.users.index', compact('users'));
    }
}
