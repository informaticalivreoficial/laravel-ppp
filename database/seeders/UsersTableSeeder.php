<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => env('ADMIN_NOME'),
                'email' => env('ADMIN_EMAIL'),
                'email_verified_at' => now(),
                'password' => bcrypt(env('ADMIN_PASS')),
                'senha' => env('ADMIN_PASS'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'cpf' => '11111111111',
                'rg' => '111111111',            
                'uf' => '25',
                'nasc' => '2004-12-14',
                'created_at' => now(),//Data e hora Atual
                'genero' => 'masculino',
                'cidade' => '5351',
                'telefone' => '11111111',
                'celular' => '11111111',
                'whatsapp' => '11111111',
                //'superadmin' => 1,
                'status' => 1
            ],
            [
                'id' => 2,
                'name' => 'João Alberto',
                'email' => 'joaoalberto@teste.com.br',
                'email_verified_at' => now(),
                'password' => bcrypt(env('joao0981')),
                'senha' => 'joao0981',
                'remember_token' => \Illuminate\Support\Str::random(10),
                'cpf' => '22222222222',
                'rg' => '222222222',            
                'uf' => '25',
                'cidade' => '5351',
                'nasc' => '2004-12-14',
                'created_at' => now(),//Data e hora Atual
                'genero' => 'masculino',
                'telefone' => '22222222',
                'celular' => '222222222',
                'whatsapp' => '222222222',
                //'admin' => 1,
                'status' => 1
            ]
            
        ]);
    }
}
