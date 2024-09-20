<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadTechnician;
use App\Models\Role;
use App\Models\Technician;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function createLeadTech(Request $request)
    {
        $techniciens = Technician::all();


        return view('admin.dashboard.users.create_leadtech', compact( 'techniciens'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction(); // Démarre une transaction pour garantir l'intégrité des données
        try {
            // Valider les données d'entrée
            $technicienData = $request->validate([
                'user_id' => 'required|exists:users,id', // vérifier si l'utilisateur existe
                'speciality' => 'required|string',
                'grade' => 'required|string',
            ]);

            // Vérifier si cet utilisateur n'est pas déjà un technicien
            if (Technician::where('user_id', $technicienData['user_id'])->exists()) {
                throw new Exception('Cet utilisateur est déjà associé à un technicien.');
            }

            // Créer un nouveau technicien
            $technicien = Technician::create($technicienData);

            // Trouver l'utilisateur lié à ce technicien
            $user = User::find($technicienData['user_id']);

//            // Détacher le rôle par défaut "Employee"
//            $employeeRole = Role::where('name', 'Employee')->first();
//            if ($employeeRole) {
//                $user->roles()->detach($employeeRole->id);
//            }

            // Rechercher le rôle "Technician"
            $technicianRole = Role::where('name', 'Technician')->first();

            // Vérifier si le rôle "Technician" existe
            if ($technicianRole) {
                // Associe le rôle "Technician" à cet employé
                $technicien->roles()->attach($technicianRole->id);
            } else {
                // Gérer l'absence du rôle "Technician"
                throw new Exception('Le rôle Technician est introuvable.');
            }

            // Si tout est réussi, on valide la transaction
            DB::commit();

            // Log la création réussie
            Log::info('Technicien créé avec succès.', ['technicien' => $technicien]);

            return redirect()->route('admin.users')->with('success', 'Le technicien a été créé avec succès.');
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack(); // Annule la transaction si une erreur de validation survient

            // Log les erreurs de validation
            Log::error('Échec de la validation du technicien.', [
                'errors' => $e->errors(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec les erreurs
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        catch (Exception $e) {
            DB::rollBack(); // Annule la transaction en cas d'exception

            // Log toutes les autres exceptions
            Log::error('Échec de création du technicien.', [
                'message' => $e->getMessage(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec un message d'erreur générique
            return redirect()->back()->with('error', 'Échec de création du technicien. Veuillez réessayer plus tard.');
        }
    }

    public function storeLeadTechnician(Request $request)
    {
        DB::beginTransaction();
        try {

            // Validation des données
            $chefTechnicienData  = $request->validate([
                'technician_id' => 'required|exists:technician,id', // Vérifier si le technicien existe
                'speciality' => 'required|string',
                'grade' => 'required|string',
            ]);

            // Créer un nouveau chef technicien
            $chefTechnicien = LeadTechnician::create($chefTechnicienData);
            //dd($chefTechnicien);
            // Détacher le rôle par défaut "Employee" et attacher le rôle "Lead_Technician"
            $technician = Technician::findOrFail($chefTechnicienData['technician_id']);
            $user = User::findOrFail($technician->user_id);

//            $employeeRole = Role::where('name', 'Employee')->first();
//            if ($employeeRole) {
//                $user->roles()->detach($employeeRole->id);
//            }

            $leadTechnicianRole = Role::where('name', 'Lead_Technician')->first();
            if ($leadTechnicianRole) {
                $user->roles()->attach($leadTechnicianRole->id);
            }

            DB::commit();
            return redirect()->route('admin.users')->with('success', 'Le Chef technicien a été créé avec succès.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Échec de création du chef technicien. Veuillez réessayer plus tard.');
        }
    }




    public function getAllUsers()
    {
        $users = User::all();
        return view('admin.dashboard.users.index', compact('users'));
    }
}
