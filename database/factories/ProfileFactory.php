<?php
use Faker\Generator as Faker;
$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        // 'image' => $faker->image('public/images',400,300, null, false),
        // 'img_id' => null,
    ];
});