<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'full_name' => 'Teste - Geovanny Lino Coutinho',
            'password' => 'teste@321',
            'email' => 'geovannylc@gmail.com'
        ];
        User::create($data);
        var_dump($data);
    }
}
