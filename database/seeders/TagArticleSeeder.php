<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ArticleTag;
use App\Models\Article;
use App\Models\Tag;

class TagArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tags = Tag::factory(10)->create();

        // Create 5 articles and associate random tags
        Article::factory(5)->create()->each(function ($article) use ($tags) {
            $article->tags()->attach(
                $tags->pluck('id')->toArray()
            );
        });
        

    }
}
