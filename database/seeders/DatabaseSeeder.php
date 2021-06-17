<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // initial data
        $this->call(RoleSeeder::class);

        $migrate = $this->command->confirm('Do you want to migrate the old database?');

        // data migration
        if ($migrate) {
            try {
                // check if the second database connection is active
                DB::connection('mysql2')->getPdo();
            } catch (Exception $e) {
                $this->command->error('Could not connect to the legacy database. Please check your configuration. The old database is not migrated.');
                return;
            }

            $this->call(DataMigrationSeeder::class);
        }

        $test = $this->command->confirm('Do you want to seed test data?');

        // test data
        if ($test) {
            $this->call(NewsItemSeeder::class);
            $this->call(UserSeeder::class);
        }
    }
}
