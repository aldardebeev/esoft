<?php

namespace Database\Seeders;

use App\Modules\Note\Models\Note;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Note::factory()->count(10)->create();
    }
}
