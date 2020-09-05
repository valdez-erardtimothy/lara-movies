<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // create an admin account for CRUD guarding
        \App\User::create([        
            'name' => 'admin',
            'email' => 'adminized@admin.jp',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => null,
            'is_admin' => true
        ])->save();

        // builtin factory for user seeding
        factory(App\User::class, 50)->create()->each(function ($user) {

        });
    }
}
