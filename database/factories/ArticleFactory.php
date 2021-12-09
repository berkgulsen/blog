<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title=$this->faker->sentence(2);
        return [
            'categoryId'=>$this->faker->numberBetween(1,5),
            'title'=>$title,
            'imagePath'=>$this->faker->imageUrl(800,400,'cats',true),
            'content' =>$this->faker->realTextBetween(100,250),
            'slug'=>str::slug($title),
            'hit'=>$this->faker->numberBetween(3,88),
            'created_at'=>$this->faker->dateTime($max = 'now')
        ];
    }
}
