<?php

use App\User;
use App\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Persona::class, 100)->create();
        factory(User::class, 5)->create();
    }
}
