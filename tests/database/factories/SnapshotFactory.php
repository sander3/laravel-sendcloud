<?php

use Tests\Models\Snapshot;
use Faker\Generator as Faker;

$factory->define(Snapshot::class, function (Faker $faker) {
    return [
        'title'           => $faker->sentence,
        'url'             => $faker->url,
    ];
});
