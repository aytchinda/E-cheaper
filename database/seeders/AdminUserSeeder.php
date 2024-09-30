<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un rôle ROLE_ADMIN si il n'existe pas déjà
        $adminRole = Role::firstOrCreate([
            'name' => 'Admin',
            'description' => 'Administrateur du site',
            'value' => 'ROLE_ADMIN',
        ]);

        // Créer un utilisateur administrateur
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Hacher le mot de passe
        ]);

        // Assigner le rôle ROLE_ADMIN à l'utilisateur
        $adminUser->roles()->attach($adminRole->id);
    }
}
