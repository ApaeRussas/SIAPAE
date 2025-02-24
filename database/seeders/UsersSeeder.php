<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'name' =>  'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('333729015'),
            'access_level' => 'admin',
            'position' => '---', 
            'state_user' => 'alive',
         ]);

         User::create([
            'name' =>  'Kelvia Maria Gonçalves Viana',
            'email' => 'kelvia.mgv@gmail.com',
            'password' => bcrypt('12345678'),
            'access_level' => 'admin',
            'position' => 'Cordenador(a)', 
            'state_user' => 'alive',
         ]);

         User::create([
            'name' =>  'Sâmia Maria Gonçalves Viana da Silva',
            'email' => 'samiamariagoncalves@gmail.com',
            'password' => bcrypt('12345678'),
            'access_level' => 'user',
            'position' => 'Cordenador(a)', 
            'state_user' => 'alive',
         ]);

         User::create([
            'name' =>  'Francisca Isadélia da Silva Nogueira',
            'email' => 'isadelianogueira@gmail.com',
            'password' => bcrypt('12345678'),
            'access_level' => 'user',
            'position' => 'Professor(a)', 
            'state_user' => 'alive',
         ]);

         User::create([
            'name' =>  'Gláucia Lopes de Lima Bezerra',
            'email' => 'glaucialopesbezerra@gmail.com',
            'password' => bcrypt('12345678'),
            'access_level' => 'user',
            'position' => 'Professor(a)', 
            'state_user' => 'alive',
         ]);

         User::create([
            'name' =>  'Maria José Queiroz de Freitas',
            'email' => 'maijose_queiroz@hotmail.com',
            'password' => bcrypt('12345678'),
            'access_level' => 'user',
            'position' => 'Professor(a)', 
            'state_user' => 'alive',
         ]);
    }
}