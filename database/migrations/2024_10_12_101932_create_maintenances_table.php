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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('applicant')->nullable();
            $table->string('responsible')->nullable();
            $table->string('departement')->nullable();
            $table->string('door_number')->nullable();
            $table->string('hardware')->nullable();
            $table->string('hardware_other')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('model')->nullable();
            $table->string('os_type')->nullable();
            $table->string('licence')->nullable();
            $table->string('other')->nullable();
            $table->text('comment')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('intervention_type')->nullable();
            $table->string('other_intervention')->nullable();
            $table->string('designation')->nullable();
            $table->integer('quantity')->nullable();
            $table->boolean('connected')->default(false);
            $table->string('protocol')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
