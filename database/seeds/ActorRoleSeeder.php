<?php

use Illuminate\Database\Seeder;
use App\ActorRole;

class ActorRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ActorRole::create(['role' => 'Protagonist']);
        ActorRole::create(['role' => 'Antagonist']);
        ActorRole::create(['role' => 'Supporting Character']);
    }
}
