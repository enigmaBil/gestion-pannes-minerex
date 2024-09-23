<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Panne;
use App\Models\User;
use App\Notifications\PanneSignalee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function index()
    {

        return view('employee.index');
    }

    public function getAllPannes()
    {
        $pannes = auth()->user()->pannes ?? collect();
//        dd($pannes);
        return view('employee.panne.index', compact('pannes'));
    }

    public function create()
    {
        return view('employee.panne.create');
    }

    public function store(Request $request)
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

            // Créer une nouvelle panne
            $panne = Panne::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'type' => $validated['type'],
                'status' => 'en attente',
                'reporting_date' => now(),
                'user_id' => $validated['user_id'],
            ]);

            // Envoi de la notification à l'administrateur et au chef des techniciens
            $administrateurs = User::whereHas('roles', function($query) {
                $query->where('name', 'Admin');
            })->get();

            $chefsTechniciens = User::whereHas('roles', function($query) {
                $query->where('name', 'Lead_Technician');
            })->get();

            foreach ($administrateurs as $admin) {
                $admin->notify(new PanneSignalee($panne, $request->all()));
            }
            foreach ($chefsTechniciens as $chefsTechnicien) {
                $chefsTechnicien->notify(new PanneSignalee($panne, $request->all()));
            }

            // Si tout est réussi, on valide la transaction
            DB::commit();
            // Log la création réussie
            Log::info('Panne created successfully.', $validated);

            alert()->success('Panne signalée','La Panne a été signalée avec succès.');

            return redirect()->route('panne.index')->with('success', 'La Panne a été signalée avec succès.');
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack(); // Annule la transaction si une erreur de validation survient
            // Log les erreurs de validation
            Log::error('Validation failed for creating panne.', [
                'errors' => $e->errors(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec les erreurs
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        catch (\Exception $e) {
            DB::rollBack(); // Annule la transaction en cas d'exception
            // Log toutes les autres exceptions
            Log::error('Failed to create panne.', [
                'message' => $e->getMessage(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec un message d'erreur générique
            return redirect()->back()->with('error', 'Failed to create panne. Please try again.');
        }

    }

    public function show($id)
    {
        return view('employee.panne.show');
    }

    public function edit($id)
    {
        return view('employee.panne.edit');
    }

    public function update($id)
    {

    }

}
