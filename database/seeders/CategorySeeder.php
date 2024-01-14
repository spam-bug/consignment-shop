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
        foreach ($this->categories() as $category) {
            Category::create($category);
        }
    }

    public function categories(): array
    {
        return [
            ['name' => 'Instruments'],
            ['name' => 'Furnitures'],
            ['name' => 'Shoes'],
            ['name' => 'Clothes'],
            ['name' => 'Electronics']
        ];
    }
}
