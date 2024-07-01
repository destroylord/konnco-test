<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Kursi', 'Meja', 'Lemari', 'Komode', 'Lemari Besar', 'Lemari Kecil',
            'Rak', 'Rak Buku', 'Kursi Sofa', 'Tempat Tidur'
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create(['name' => $category]);
        }
    }
}
