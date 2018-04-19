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
        'id_user' => $faker->numberBetween(1,5),
        'id_user_type' => $faker->numberBetween(1,3),
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





