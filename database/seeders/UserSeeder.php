<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cashier = Role::find(3);

        for ($code = 1; $code <= 5; $code++) {
            User::create([
                'code' => $code,
                'password' => Hash::make('geheim'),
                'remember_token' => Str::random(10),
            ])->roles()->save($cashier); // cashier
        }
    }
}
