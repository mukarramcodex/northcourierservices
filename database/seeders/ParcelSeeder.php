<?php

namespace Database\Seeders;

use App\Models\Parcel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParcelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Parcel::factory()->count(15)->create();
    }
}
