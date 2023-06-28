<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::query()->create([
            'name' => 'Category 1',
            'code' => '12345678',
            'color' => '#FF0000',
        ]);
        Category::query()->create([
            'name' => 'Category 2',
            'code' => '87654321',
            'color' => '#00FF00',
        ]);
        Category::query()->create([
            'name' => 'Category 3',
            'code' => '12348715',
            'color' => '#0000FF',
        ]);
        Category::query()->create([
            'name' => 'Category 4',
            'code' => '12348763',
            'color' => '#0001FF',
        ]);
    }
}
