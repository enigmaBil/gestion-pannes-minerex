<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id(); // Identifiant unique
            $table->string('product_name'); // Nom du produit
            $table->text('description')->nullable(); // Description du produit, optionnel
            $table->integer('quantity')->default(0); // Quantité en stock
            $table->string('location')->nullable(); // Emplacement du stock, optionnel

            // Colonnes pour suivre les actions des utilisateurs
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // Utilisateur qui a créé
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null'); // Utilisateur qui a mis à jour
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('set null'); // Utilisateur qui a supprimé

            $table->timestamps(); // created_at et updated_at
            $table->softDeletes(); // Pour permettre les suppressions douces (soft deletes)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};
