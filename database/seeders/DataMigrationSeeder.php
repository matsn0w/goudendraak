<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
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
            if (1 == $user->isAdmin) {
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
            if (null != MenuCategory::where('name', $item->soortgerecht)->first()) {
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

        $this->command->info('Migrating sales...');

        $sales = DB::connection('mysql2')->table('sales')->get();
        $orders = [];

        foreach ($sales as $item) {
            // build a custom array, group items by order date
            if (!isset($orders[$item->saleDate])) {
                $orders[$item->saleDate] = [$item];
            } else {
                array_push($orders[$item->saleDate], $item);
            }
        }

        // loop through all 'orders' (just assembled)
        foreach ($orders as $order) {
            // make a proper timestamp
            $timestamp = Carbon::parse($order[0]->saleDate);

            // insert order
            DB::connection('mysql')->table('orders')->insert([
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);

            // find new order id
            $order_id = Order::whereDate('created_at', $timestamp)
                ->whereTime('created_at', $timestamp)
                ->first()
                ->id;

            foreach ($order as $item) {
                // insert all order items
                DB::connection('mysql')->table('order_item')->insert([
                    'order_id' => $order_id,
                    'item_id' => $item->itemId,
                    'amount' => $item->amount,
                ]);
            }
        }
    }
}
