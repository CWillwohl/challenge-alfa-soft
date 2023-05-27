<?php

namespace Database\Seeders;

use App\Models\Contact;
use Database\Factories\ContactFactory;
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
        Contact::factory()->count(100)->create();

        $this->call([
            UserSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
