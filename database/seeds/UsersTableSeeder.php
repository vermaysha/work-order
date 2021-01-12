<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::insert([
            'fullname' => 'Developer',
            'username' => 'developer',
            'email' => 'developer@dev.com',
            'password' => Hash::make('developer'),
            'role' => 'developer',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // User::insert([
        //     'fullname' => 'Juju',
        //     'username' => 'juju',
        //     'email' => 'juju@mail.com',
        //     'password' => Hash::make('developer'),
        //     'role' => 'developer',
        // ]);

        // User::insert([
        //     'fullname' => 'Jimmy',
        //     'username' => 'jimmy',
        //     'email' => 'jimmy@dev.com',
        //     'password' => Hash::make('jimmy'),
        //     'role' => 'jimmy',
        // ]);

        // User::insert([
        //     'fullname' => 'Ashary',
        //     'username' => 'ashary',
        //     'email' => 'ashary@dev.com',
        //     'password' => Hash::make('ashary'),
        //     'role' => 'developer',
        // ]);

        factory(User::class, 9)->create();
    }
}
