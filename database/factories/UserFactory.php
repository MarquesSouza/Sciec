<?php


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(App\Entities\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'cpf'  => $faker->unique()->numberBetween(1,999999999),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'celular' => $faker->phoneNumber,
        'status' => $faker->boolean,
        'remember_token' => str_random(10),

    ];
});

$factory->define(App\Entities\UserTypeUser::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1,5),
        'user_type_id' => $faker->numberBetween(1,3),
        'status' => $faker->boolean,
    ];
});
$factory->define(App\Entities\UserType::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->sentence,
        'descricao' => $faker->sentence,
        'status' => $faker->boolean,
    ];
});

$factory->define(App\Entities\Event::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->sentence,
        'descricao' => $faker->sentence,
        'local' => $faker->sentence,
        'data_inicio' => $faker->dateTime,
        'data_conclusao' => $faker->dateTime,
        'situacao' => $faker->numberBetween(0,1),
        'status' => $faker->numberBetween(0,1),
        'coordenador' => $faker->sentence
];
});

$factory->define(App\Entities\Activity::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->sentence,
        'descricao' => $faker->sentence,
        'local' => $faker->sentence,
        'data_inicio' => $faker->dateTime,
        'data_conclusao' => $faker->dateTime,
        'horas' => $faker->time(),
        'qtd_inscritos' => $faker->numerify(),
        'status' => $faker->numberBetween(0,1)
];
});



