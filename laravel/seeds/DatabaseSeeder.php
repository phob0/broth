<?php

use App\User;
use App\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $record = User::create([
            	'name' => 'Phobo',
            	'email' => 'phobo@broth.ro',
            	'phone' => '1',
            	'password' => \Hash::make('phobo'),
            ]);
            $record->roles()->create([
            	'role' => 'superadmin',
            	'target_type' => 'application',
            	'target_id' => 0
            ]);
        });
    }
}