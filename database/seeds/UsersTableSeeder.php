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
        	'name' => 'Admin',
        	'nickname' => 'admin',
        	'password' => hash('sha256','admin'),
            'admin' => User::ADMIN_USER,
            'actived' => User::USER_ACTIVED,
        ]);
    }
}
