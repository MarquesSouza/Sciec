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

        /*---------------Tipos de Usuários---------------------------*/
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

        /*---------------------------------------------------------------*/
        factory(App\Entities\UserTypeUser::class, 5)->create();

        /*--------------------------Instituição-------------------------------*/
        App\Entities\Institution::create([
            'nome' => 'IFTO - Campus Paraíso',
            'descricao' => 'Instituição de nível médio e superior',
            'site' => 'portal.ifto.edu.br/paraiso',
            'email' => 'institucional.paraiso@ifto.edu.br',
            'telefone' => '(63)33610300',
            'status' => '1',
        ]);
        App\Entities\Institution::create([
            'nome' => 'IFTO - Campus Palmas',
            'descricao' => 'Instituição de nível médio e superior',
            'site' => 'portal.ifto.edu.br/paalmas',
            'email' => 'institucional.palmas@ifto.edu.br',
            'telefone' => '(63)32150305',
            'status' => '1',
        ]);

        /*---------------------------Tipo de Atividade------------------------------------*/
        App\Entities\TypeActivity::create([
            'nome' => 'Palestra',
            'descricao' => 'Palestra',
            'status' => '1',
        ]);
        App\Entities\TypeActivity::create([
            'nome' => 'Maratona de Programação',
            'descricao' => 'Discursões de determinados temas com os participantes do evento',
            'status' => '1',
        ]);
        App\Entities\TypeActivity::create([
            'nome' => 'Minicurso',
            'descricao' => 'Cursos de curta duração para iniciantes',
            'status' => '1',
        ]);

        /*---------------------------------------------------------------*/
        factory(App\Entities\UserActivityType::class, 5)->create();

        /*-----------------------------Eventos----------------------------------*/
        \App\Entities\Event::create([
            'nome' => 'VI JTGTI',
            'descricao' => 'Evento de Tecnologia da Informação do IFTO',
            'local' => 'IFTO - Campus Paraíso do Tocantins - TO',
            'data_inicio' => '2018-05-08 19:00:00',
            'data_conclusao' => '2018-05-10 22:00:00',
            'situacao' => '1',
            'status' => '1',
            'institutions_id'=> '1',
            'coordenador' => 'Fábio Vidal',
        ]);
        \App\Entities\Event::create([
            'nome' => 'V SEMAD',
            'descricao' => 'Evento de Administração do IFTO',
            'local' => 'IFTO - Campus Paraíso do Tocantins - TO',
            'data_inicio' => '2018-06-08 14:00:00',
            'data_conclusao' => '2018-06-10 18:00:00',
            'situacao' => '1',
            'status' => '1',
            'institutions_id'=> '1',
            'coordenador' => 'Márcia',
        ]);
        \App\Entities\Event::create([
            'nome' => 'HACKATON',
            'descricao' => 'Evento de Programação do IFTO',
            'local' => 'IFTO - Campus Palmas - TO',
            'data_inicio' => '2018-09-07 14:00:00',
            'data_conclusao' => '2018-09-09 18:00:00',
            'situacao' => '1',
            'status' => '1',
            'institutions_id'=> '2',
            'coordenador' => 'Gilberto',
        ]);

        /*-----------------------------Atividades----------------------------------*/
        App\Entities\Activity::create([
            'nome' => 'Minicurso Robótica - Robô Lego',
            'descricao' => 'Introdução a robótica utilizando robô de lego',
            'local' => 'IFTO - Campus Paraíso do Tocantins - TO',
            'data_inicio' => '2018-06-09 14:00:00',
            'data_conclusao' => '2018-06-08 18:00:00',
            'horas' => '04:00:00',
            'qtd_inscritos' => '100',
            'status' => '1',
            'type_activities_id'=> '3',
            'events_id' => '1',
        ]);
        App\Entities\Activity::create([
            'nome' => 'Como Empreender Com Sucesso',
            'descricao' => 'Palestra sobre o que saber para empreender com sucesso',
            'local' => 'IFTO - Campus Paraíso do Tocantins - TO',
            'data_inicio' => '2018-06-08 14:00:00',
            'data_conclusao' => '2018-06-10 18:00:00',
            'horas' => '04:00:00',
            'qtd_inscritos' => '100',
            'status' => '1',
            'type_activities_id'=> '1',
            'events_id' => '2',
        ]);
        App\Entities\Activity::create([
            'nome' => 'Maratona de Programação',
            'descricao' => '24 horas de programação direta',
            'local' => 'IFTO - Campus Palmas - TO',
            'data_inicio' => '2018-09-07 19:00:00',
            'data_conclusao' => '2018-09-09 19:00:00',
            'horas' => '24:00:00',
            'qtd_inscritos' => '50',
            'status' => '1',
            'type_activities_id'=> '2',
            'events_id' => '3',
        ]);
        /*---------------------------------------------------------------*/
    }
}