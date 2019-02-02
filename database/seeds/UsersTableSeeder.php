<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!User::all()->count()) {
            User::create([
                'email' => 'ad@ad.ad',
                'name' => 'admin',
                'password' => 'admin'
            ]);
        }
    }
}
