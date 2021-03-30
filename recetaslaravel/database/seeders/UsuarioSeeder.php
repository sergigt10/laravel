<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Sergi',
            'email' => 'sergi@sergi.com',
            'password' => Hash::make('12345'), 
            'url' => 'http://www.sergi.com',
        ]);

        $user2 = User::create([
            'name' => 'Pablo',
            'email' => 'pablo@pablo.com',
            'password' => Hash::make('12345'), 
            'url' => 'http://www.pablo.com',
        ]);
        
    }
}
