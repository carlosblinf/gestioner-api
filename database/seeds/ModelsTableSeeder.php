<?php

use App\User;
use App\Persona;
use App\Activity;
use App\Structure;
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
        factory(Structure::class, 5)->create();
        factory(Activity::class, 10)->create();
    }
}
