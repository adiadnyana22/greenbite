<?php

namespace Database\Seeders;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::create([
            'title' => 'Apa Perbedaan Food Loss dan Food Waste?',
            'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut, suscipit quis provident voluptatibus aliquam officia magnam? Pariatur debitis, ut ducimus provident molestiae quisquam rerum reiciendis, nemo laboriosam, aliquam consequuntur cupiditate.',
            'date' => Carbon::now(),
            'image' => 'pastry1.jpeg',
        ]);

        News::create([
            'title' => 'Darurat! Sampah Makanan Orang RI Tembus Ratusan Triliun',
            'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut, suscipit quis provident voluptatibus aliquam officia magnam? Pariatur debitis, ut ducimus provident molestiae quisquam rerum reiciendis, nemo laboriosam, aliquam consequuntur cupiditate.',
            'date' => Carbon::now(),
            'image' => 'pastry2.jpeg',
        ]);

        News::create([
            'title' => '3 Cara Sederhana Mencegah Makanan Jadi Timbulan Food Waste',
            'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut, suscipit quis provident voluptatibus aliquam officia magnam? Pariatur debitis, ut ducimus provident molestiae quisquam rerum reiciendis, nemo laboriosam, aliquam consequuntur cupiditate.',
            'date' => Carbon::now(),
            'image' => 'pastry3.jpeg',
        ]);
    }
}
