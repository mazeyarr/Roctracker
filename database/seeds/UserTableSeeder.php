<?php

use App\User;
use Illuminate\Database\Seeder;

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
            'name' => 'Wiebe Zijlstra',
            'email' => 'w.zijlstra@roc-teraa.nl',
            'password' => bcrypt('wiebe123')
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
