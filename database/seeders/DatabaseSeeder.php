<?php

namespace Database\Seeders;

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
        \App\Models\Admin::factory()->create([
            'name' => "Test Admin",
            'email' => 'admin@example.com'
        ]);
        for($i = 1; $i <= 5; $i++) {
            \App\Models\Owner::factory()->create([
                'name' => 'Test Owner'. $i,
                'email' => 'owner'. $i. '@example.com',
            ]);
        }
        $this->call(RestaurantSeeder::class);
        $this->call(DetailSeeder::class);

    }
}
