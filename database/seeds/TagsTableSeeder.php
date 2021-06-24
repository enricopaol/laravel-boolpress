<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Illuminate\Support\Str;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Ricette veloci',
            'Ricette della nonna',
            'Ricette senza glutine',
            'Ricette vegetariane',
            'Ricette vegane'
        ];

        foreach($tags as $tag_name) {
            $new_tag = new Tag;
            $new_tag->name = $tag_name;
            $new_tag->slug = Str::slug($tag_name, '-');
            $new_tag->save();
        }
    }
}
