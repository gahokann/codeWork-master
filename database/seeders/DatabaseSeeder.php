<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Language;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)->create();
        $tags = Tag::factory(20)->create();
        Category::factory(20)-> create();
        Language::factory(20)-> create();
        $recipes = Recipe::factory(20)->create();

        foreach ($recipes as $val) {
            $tagsIds = $tags->unique()->random(5)->pluck('id');

            $val->tags()->attach($tagsIds);
        }


    }
}
