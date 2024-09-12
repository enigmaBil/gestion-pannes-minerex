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
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->after('first_name');
            $table->string('phone')->after('last_name');
            $table->string('picture')->nullable()->after('phone');
            $table->string('departement')->nullable()->after('picture');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'last_name')) {
                $table->dropColumn('last_name');
            }
            if (Schema::hasColumn('users', 'phone')) {
                $table->dropColumn('phone');
            }
            if (Schema::hasColumn('users', 'picture')) {
                $table->dropColumn('picture');
            }
            if (Schema::hasColumn('users', 'departement')) {
                $table->dropColumn('departement');
            }
        });
    }
};
