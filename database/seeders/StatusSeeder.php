<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::query()->create([
            'name' => 'New task',
            'code' => '12345678',
        ]);
        Status::query()->create([
            'name' => 'In progress',
            'code' => '87654321',
        ]);
        Status::query()->create([
            'name' => 'Complete',
            'code' => '12348765',
        ]);
        Status::query()->create([
            'name' => 'Delete',
            'code' => '12348765',
        ]);
    }
}
