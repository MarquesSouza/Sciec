<?php

use Illuminate\Database\Seeder;

class PopulacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Entities\User::class, 5)->create();

        \App\Entities\User::create([
            'name' => 'participante',
            'email' => 'participante@ifto.com',
            'cpf' => '05868249100',
            'password' => bcrypt('123123123'),
            'celular' => '727.819.4134',
            'status' => '1',
            'remember_token' => str_random(10),

        ]);

        \App\Entities\UserType::create([
            'nome' => 'Admisnistrador',
            'descricao' => 'Admisnistrador',
            'status' => '1',
        ]);
        \App\Entities\UserType::create([
            'nome' => 'Organizador',
            'descricao' => 'Organizador',
            'status' => '1',
        ]);
        \App\Entities\UserType::create([
            'nome' => 'Participante',
            'descricao' => 'Participante',
            'status' => '1',
        ]);

        factory(App\Entities\UserTypeUser::class, 5)->create();
        factory(App\Entities\Institution::class, 5)->create();
        factory(App\Entities\TypeActivity::class, 5)->create();
        factory(App\Entities\UserActivityType::class, 5)->create();
        factory(App\Entities\Event::class, 5)->create();
        factory(App\Entities\Activity::class, 5)->create();
    }
}