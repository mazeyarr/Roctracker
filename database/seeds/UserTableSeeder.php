<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            'name' => 'Mazeyar Rezaei',
            'email' => 'mazeyarr@gmail.com',
            'password' => bcrypt('mazeyar123')
        ));
        User::create(array(
            'name' => 'Zahra Abidar',
            'email' => 'z.abidar@roc-teraa.nl',
            'password' => bcrypt('welkom1')
        ));
        User::create(array(
            'name' => 'Peter Nöcker',
            'email' => 'p.nocker@roc-teraa.nl',
            'password' => bcrypt('peter123')
        ));
    }
}
