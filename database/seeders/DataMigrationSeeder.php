<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\MenuCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataMigrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Migrating users...');

        $users = DB::connection('mysql2')->table('gebruiker')->get();

        foreach ($users as $user) {
            // migrate users
            DB::connection('mysql')->table('users')->insert([
                'code' => $user->id,
                'password' => Hash::make($user->wachtwoord),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // assign admin roles
            if ($user->isAdmin == 1) {
                DB::connection('mysql')->table('role_user')->insert([
                    'role_id' => Role::where('name', 'admin')->first()->id,
                    'user_id' => User::where('code', $user->id)->first()->id,
                ]);
            }
        }

        $this->command->info('Migrating menu categories...');

        $menu = DB::connection('mysql2')->table('menu')->get();

        foreach ($menu as $item) {
            // check if the category is already present
            if (MenuCategory::where('name', $item->soortgerecht)->first() != null) {
                continue;
            }

            // migrate categories
            DB::connection('mysql')->table('menu_categories')->insert([
                'name' => $item->soortgerecht,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $this->command->info('Migrating menu items...');

        foreach ($menu as $item) {
            // find the correct category id
            $category_id = MenuCategory::where('name', 'like', "%{$item->soortgerecht}%")->first()->id;

            // migrate menu items
            DB::connection('mysql')->table('menu_items')->insert([
                'name' => $item->naam,
                'number' => $item->menunummer,
                'number_addition' => $item->menu_toevoeging,
                'category_id' => $category_id,
                'price' => $item->price,
                'description' => $item->beschrijving,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
