<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //appel des seeders pour les roles et les permissions
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);

        //creation du super utilisateur
        if (!User::where('email', 'admin@gestion_panne.cm')->exists())
        {
            $superAdmin = User::create([
                'first_name' => 'Emmanuel',
                'last_name' => 'Bilong',
                'email' => 'admin@gestion-panne.cm',
                'phone' => '656985655',

                'departement' => 'IT',
                'password' => Hash::make('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Associe le rôle "Admin" à ce super administrateur
            $adminRole = Role::where('name', 'Admin')->first();
            if ($adminRole){
                $superAdmin->roles()->attach($adminRole->id);// Attach l'ID du rôle à l'utilisateur
            }else{
                // Gérer l'absence du rôle "Admin"
                throw new Exception('Le rôle Admin est introuvable.');
            }
        }
    }
}
