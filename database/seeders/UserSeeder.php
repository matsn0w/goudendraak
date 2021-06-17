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
        // get all users
        $users = User::all();

        // init value
        $highest = 0;


        if ($users->count() > 0) {
            // find highest existing number
            $highest = $users->last()->code;
        }

        // add 5 users
        for ($code = $highest + 1; $code <= $highest + 6; $code++) {
            // find a random role
            $role = Role::all()->random();

            User::firstOrCreate([
                'code' => $code,
                'password' => Hash::make('geheim'),
                'remember_token' => Str::random(10),
            ])->roles()->save($role);
        }
    }
}
