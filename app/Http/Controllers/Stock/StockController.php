<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{
    // Afficher tous les stocks
    public function index()
    {
        $stocks = Stock::with(['creator', 'updater'])->get();
        return view('stock.index', compact('stocks'));
    }

    // Afficher le formulaire de création d'un nouveau stock
    public function create()
    {
        return view('stock.create');
    }

    // Enregistrer un nouveau stock
    public function store(Request $request)
    {
        try {
            // Valider les données d'entrée
            $validated = $request->validate([
                'product_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'quantity' => 'required|integer|min:0',
                'location' => 'nullable|string',
            ]);

            // Créer le stock et associer l'utilisateur qui l'ajoute
            $stock = Stock::create([
                'product_name' => $validated['product_name'],
                'description' => $validated['description'],
                'quantity' => $validated['quantity'],
                'location' => $validated['location'],
                'created_by' => Auth::id(),
            ]);

            alert()->success('Materiel ajouté', 'Le materiel a été ajouté avec succès.');
            return redirect()->route('stock.index')->with('success', 'Le materiel a été ajouté avec succès.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log les erreurs de validation
            Log::error('Validation failed for creating stock.', [
                'errors' => $e->errors(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec les erreurs
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log toutes les autres exceptions
            Log::error('Failed to create stock.', [
                'message' => $e->getMessage(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec un message d'erreur générique
            return redirect()->back()->with('error', 'Échec de l\'ajout du materiel. Veuillez réessayer plus tard.');
        }
    }

    // Afficher le formulaire d'édition d'un stock existant
    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        return view('stock.edit', compact('stock'));
    }

    // Afficher le formulaire d'édition d'un stock existant
    public function show($id)
    {
        $stock = Stock::findOrFail($id);
        return view('stock.show', compact('stock'));
    }

    // Mettre à jour un stock existant
    public function update(Request $request, $id)
    {
        try {
            // Valider les données d'entrée
            $validated = $request->validate([
                'product_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'quantity' => 'required|integer|min:0',
                'location' => 'nullable|string',
            ]);

            // Trouver le stock existant et le mettre à jour
            $stock = Stock::findOrFail($id);
            $stock->update([
                'product_name' => $validated['product_name'],
                'description' => $validated['description'],
                'quantity' => $validated['quantity'],
                'location' => $validated['location'],
                'updated_by' => Auth::id(),
            ]);

            alert()->success('Stock mis à jour', 'Le stock a été mis à jour avec succès.');
            return redirect()->route('stock.index')->with('success', 'Le stock a été mis à jour avec succès.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log les erreurs de validation
            Log::error('Validation failed for updating stock.', [
                'errors' => $e->errors(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec les erreurs
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            // Log toutes les autres exceptions
            Log::error('Failed to update stock.', [
                'message' => $e->getMessage(),
                'input' => $request->all(),
            ]);

            // Réafficher le formulaire avec un message d'erreur générique
            return redirect()->back()->with('error', 'Échec de la mise à jour du stock. Veuillez réessayer plus tard.');
        }
    }

    // Supprimer un stock
    public function destroy($id)
    {
        try {
            // Trouver le stock à supprimer
            $stock = Stock::findOrFail($id);

            // Enregistrer l'ID de l'utilisateur qui supprime la ligne de stock
            $stock->deleted_by = Auth::id();
            $stock->save();

            // Supprimer le stock (soft delete si configuré)
            $stock->delete();

            alert()->success('Stock supprimé', 'Le stock a été supprimé avec succès.');
            return redirect()->route('stock.index')->with('success', 'Le stock a été supprimé avec succès.');
        } catch (Exception $e) {
            // Log toutes les autres exceptions
            Log::error('Failed to delete stock.', [
                'message' => $e->getMessage(),
                'stock_id' => $id,
            ]);

            // Réafficher le formulaire avec un message d'erreur générique
            return redirect()->back()->with('error', 'Échec de la suppression du stock. Veuillez réessayer plus tard.');
        }
    }

    public function exportPdf()
    {
        try {
            // Récupérer tous les stocks avec les relations
            $stocks = Stock::with(['creator', 'updater'])->get();

            // Générer le PDF à partir de la vue
            $pdf = PDF::loadView('stock.pdf', compact('stocks'));

            // Télécharger le PDF
            return $pdf->download('fiche_de_stock.pdf');
        } catch (Exception $e) {
            // Log l'erreur
            Log::error('Failed to export stocks to PDF.', [
                'message' => $e->getMessage(),
            ]);

            // Rediriger avec un message d'erreur
            return redirect()->back()->with('error', 'Échec de l\'exportation des stocks. Veuillez réessayer plus tard.');
        }
    }

}
