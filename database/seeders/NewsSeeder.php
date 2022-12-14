<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::factory()
            ->count(50)
            ->hasResourceUrlData(1, function (array $attributes, News $news) {
                return ['no' => $news->resource_url, 'platform' => $news->resource_platform];
            })
            ->create();
    }
}
