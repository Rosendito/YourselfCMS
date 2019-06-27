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
        User::create([
        	'name'     => 'José Rosendo',
            'email'    => 'rosendito@up.tech',
            'image'    => 'rosendo.jpg',
        	'password' => bcrypt('contraseña'),
        ]);

        User::create([
        	'name'     => 'Usuario invitado',
        	'email'    => 'invitado@yourself.com',
        	'password' => bcrypt('contraseña'),
        ]);
    }
}
