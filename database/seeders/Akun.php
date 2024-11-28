<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Akun extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Xanyou',
                'email' => 'xan@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 1           
            ],
            [
                'name' => 'Zaidan',
                'email' => 'zaidan@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 2           
            ],
            [
                'name' => 'Valenn',
                'email' => 'valen@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 3          
            ],
        ];
        foreach($data as $key => $d){
            User::create($d);
        }
    }
}
