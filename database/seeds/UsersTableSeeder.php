<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

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
            'fullname' => 'Administrator',
            'username' => 'administrator',
            'email' => 'admin@mail.com',
            'password' => Hash::make('administrator'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (App::environment('local', 'development')) {
            User::insert([
                'fullname' => 'Developer',
                'username' => 'developer',
                'email' => 'developer@dev.com',
                'password' => Hash::make('developer'),
                'role' => 'developer',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        if (App::environment('local', 'development')) {
            factory(User::class, 15)->create();
        }
    }
}
