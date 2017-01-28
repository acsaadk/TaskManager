<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'first_name' => 'John',
          'last_name' => 'Doe',
          'email' => 'admin@mail.com',
          'password' => app('hash')->make('admin'),
          'isAdmin' => true
        ]);
        User::create([
          'first_name' => 'Max',
          'last_name' => 'Donoli',
          'email' => 'max@email.com',
          'password' => app('hash')->make('1234')
        ]);
        User::create([
          'first_name' => 'Richard',
          'last_name' => 'Trainor',
          'email' => 'richard@email.com',
          'password' => app('hash')->make('1234')
        ])
    }
}
