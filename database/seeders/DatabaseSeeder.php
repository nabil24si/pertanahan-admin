<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            WargaSeeder::class,
            PersilSeeder::class,
            CreateDokumenPersilDummy::class,
            CreateSengketaPersilDummy::class,

            // Panggil seeder peta persil baru di sini
            CreatePetaPersilDummy::class,
        ]);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
