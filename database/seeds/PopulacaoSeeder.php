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
        \App\Entities\TypeUser::create([
            'nome' => 'Admisnistrador',
            'descricao' => 'admisnistrador',
            'status' => '1',
        ]);
        \App\Entities\TypeUser::create([
            'nome' => 'Organizador',
            'descricao' => 'Organizador',
            'status' => '1',
        ]);
        \App\Entities\TypeUser::create([
            'nome' => 'Participante',
            'descricao' => 'Participante',
            'status' => '1',
        ]);

        factory(App\Entities\UserTypeUser::class, 5)->create();
    }
}
