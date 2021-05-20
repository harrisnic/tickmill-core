<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create();
        Client::factory(10)->create();
        Transaction::factory(60)->create();
    }
}
