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
    }
}
