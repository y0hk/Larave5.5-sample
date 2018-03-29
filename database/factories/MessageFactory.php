<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    static $seed = 0;
    $faker->seed($seed++);

    return [
        // 新規作成して割り当てる場合
//        'user_id' => factory('App\User')->create()->id,
        'user_id' => $faker->numberBetween(1, 10),
        'title' => $faker->realText(10),
        'content' => $faker->realText(250),
    ];
});
