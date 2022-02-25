<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funcionario')->insert([
            'nome_completo'=>Str::random(12),
            'email'=>Str::random(12).'@gmail.com',
            'password'=>Hash::make('password'),
            'saldo_atual'=>Hash::make('password'),
        ]);
    }
}
