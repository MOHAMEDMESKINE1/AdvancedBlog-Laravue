<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Comment::create([
            'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae, tenetur cum, voluptate aut, officiis id earum totam quam a quas accusamus eos minima distinctio pariatur.
',
            'user_id'=>1,
            'post_id'=>1,
        ]);
       Comment::create([
            'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae, tenetur cum, voluptate aut, officiis id earum totam quam a quas accusamus eos minima distinctio pariatur.
',
            'user_id'=>1,
            'post_id'=>2,
        ]);
       Comment::create([
            'body'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae, tenetur cum, voluptate aut, officiis id earum totam quam a quas accusamus eos minima distinctio pariatur.
',
            'user_id'=>1,
            'post_id'=>3,
        ]);
    }
}
