<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    $events = \App\Entities\Event::all();
    return view('home.index', compact('events'));
})->name('painel');*/

Route::get('/', 'EventsController@index')->name('painel');

Auth::routes();

Route::get('/home', 'EventsController@index')->name('home');

Route::get('token', function (){
    $http = new GuzzleHttp\Client;
    $response = $http->post('http://public.test/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '2',
            'client_secret' => 'WaZHjGmlb20UjQ0bQ4XEAOrCLcFeaatAfVbdizgP',
            'username' => 'marques',
            'password' => '123456',
            'scope' => '',
        ],
    ]);
    return json_decode((string) $response->getBody(), true);
});

Route::post('api/login', 'Auth\AuthApiLoginController@authenticated');

Route::prefix('admin')->group(function () {   /** Rotas do administrador */
    Route::prefix('user')->group(function () { /** Rotas do Controler Usuario */
        Route::get('cad', 'UsersController@cad_user')->name('');
        Route::get('index', 'UsersController@index')->name('');
        Route::post('store', 'UsersController@store')->name('');
        Route::get('show/{id}', 'UsersController@show')->name('');
        Route::get('show/', 'UsersController@show')->name('');
        Route::post('delete/{id}', 'UsersController@destroy')->name('');
        Route::get('edit/{id}', 'UsersController@edit')->name('');
        Route::post('update/{id}', 'UsersController@update')->name('');
    });
    Route::prefix('report')->group(function () { /** Rotas de Relatorios */
        Route::get('show', 'HomeController@index')->name('');
    });
    Route::prefix('config')->group(function () { /** Rotas de Configuração */
        Route::prefix('type_activity')->group(function () { /** Rotas de Configuração  tipo de atividade*/
            Route::get('cad', 'TypeActivitiesController@cad')->name('');
            Route::post('store', 'TypeActivitiesController@store')->name('');
            Route::get('index', 'TypeActivitiesController@index')->name('');
            Route::get('edit/{id}', 'TypeActivitiesController@edit')->name('');
            Route::get('show/{id}', 'TypeActivitiesController@show')->name('');
            Route::get('show/', 'TypeActivitiesController@show')->name('');
            Route::post('update/{id}', 'TypeActivitiesController@update')->name('');
            Route::post('delete/{id}', 'TypeActivitiesController@destroy')->name('');
        });
        Route::prefix('user_type')->group(function () { /** Rotas de Configuração tipo de users*/
            Route::get('cad', 'UserTypesController@cad')->name('');
            Route::post('store', 'UserTypesController@store')->name('');
            Route::get('index', 'UserTypesController@index')->name('');
            Route::get('edit/{id}', 'UserTypesController@edit')->name('');
            Route::get('show/{id}', 'UserTypesController@show')->name('');
            Route::get('show/', 'UserTypesController@show')->name('');
            Route::post('update/{id}', 'UserTypesController@update')->name('');
            Route::post('delete/{id}', 'UserTypesController@destroy')->name('');
        });
        Route::prefix('user_activity_type')->group(function () { /** Rotas de Configuração tipo usuario atividade, dentro do evento */
            Route::get('cad', 'UserActivityTypesController@cad')->name('');
            Route::post('store', 'UserActivityTypesController@store')->name('');
            Route::get('index', 'UserActivityTypesController@index')->name('');
            Route::get('edit/{id}', 'UserActivityTypesController@edit')->name('');
            Route::get('show/{id}', 'UserActivityTypesController@show')->name('');
            Route::get('show/', 'UserActivityTypesController@show')->name('');
            Route::post('update/{id}', 'UserActivityTypesController@update')->name('');
            Route::post('delete/{id}', 'UserActivityTypesController@destroy')->name('');
        });
        Route::prefix('institution')->group(function () { /** Rotas de Configuração Instituição */
            Route::get('cad', 'InstitutionsController@cad')->name('');
            Route::post('store', 'InstitutionsController@store')->name('');
            Route::get('index', 'InstitutionsController@index')->name('');
            Route::get('edit/{id}', 'InstitutionsController@edit')->name('');
            Route::get('show/{id}', 'InstitutionsController@show')->name('');
            Route::get('show/', 'InstitutionsController@show')->name('');
            Route::post('update/{id}', 'InstitutionsController@update')->name('');
            Route::post('delete/{id}', 'InstitutionsController@destroy')->name('');
        });
    });
    Route::prefix('event')->group(function () { /** Rotas do Evento*/
        Route::get('cad', 'EventsController@cad')->name('');
        Route::post('store', 'EventsController@store')->name('');
        Route::get('index', 'EventsController@index')->name('');
        Route::get('edit/{id}', 'EventsController@edit')->name('');
        Route::get('show/{id}', 'EventsController@show')->name('');
        Route::get('show/', 'EventsController@show')->name('');
        Route::post('update/{id}', 'EventsController@update')->name('');
        Route::post('delete/{id}', 'EventsController@destroy')->name('');

        Route::prefix('{event_id}/activity')->group(function () { /** Rotas das Atividade */
            Route::get('cad', 'ActivitiesController@cad')->name('');
            Route::post('store', 'ActivitiesController@store')->name('');
            Route::get('index', 'ActivitiesController@index')->name('');
            Route::get('edit/{id}', 'ActivitiesController@edit')->name('');
            Route::get('show/{id}', 'ActivitiesController@show')->name('');
            Route::get('show/', 'ActivitiesController@show')->name('');
            Route::post('update/{id}', 'ActivitiesController@update')->name('');
            Route::post('delete/{id}', 'ActivitiesController@destroy')->name('');
            Route::prefix('{id}/frequency')->group(function () { /** Rotas das Frequencia */
                Route::get('show/{ty_id}', 'ActivitiesController@frequencia')->name('');
                Route::post('update/{fe_id}', 'UsersActivitiesController@update')->name('');
            });
        });
    });
});

Route::prefix('org')->group(function () {   /** Rotas do Organizador */
    Route::prefix('event')->group(function () { /** Rotas do Evento*/
        Route::get('cad', 'EventsController@cad')->name('');
        Route::post('store', 'EventsController@store')->name('');
        Route::get('index', 'EventsController@index')->name('');
        Route::get('edit/{id}', 'EventsController@edit')->name('');
        Route::get('show/{id}', 'EventsController@show')->name('');
        Route::get('show/', 'EventsController@show')->name('');
        Route::post('update/{id}', 'EventsController@update')->name('');
        Route::post('delete/{id}', 'EventsController@destroy')->name('');

        Route::prefix('{event_id}/activity')->group(function () { /** Rotas das Atividade */
            Route::get('cad', 'ActivitiesController@cad')->name('');
            Route::post('store', 'ActivitiesController@store')->name('');
            Route::get('index', 'ActivitiesController@index')->name('');
            Route::get('edit/{id}', 'ActivitiesController@edit')->name('');
            Route::get('show/{id}', 'ActivitiesController@show')->name('');
            Route::get('show/', 'ActivitiesController@show')->name('');
            Route::post('update/{id}', 'ActivitiesController@update')->name('');
            Route::put('delete/{id}', 'ActivitiesController@destroy')->name('');
            Route::prefix('{id}/frequency')->group(function () { /** Rotas das Frequencia */
                Route::get('show/{ty_id}', 'ActivitiesController@frequencia')->name('');
                Route::post('update/{fe_id}', 'UsersActivitiesController@update')->name('');
            });
        });
    });
});
Route::prefix('user')->group(function () {   /** Rotas do Usuario */
    Route::prefix('event')->group(function () { /** Rotas de Usuario Evento */


        Route::get('show', 'EventsController@show')->name('');
        Route::get('{event_id}/insc', 'EventsController@inscricaoEvento')->middleware('auth');

        Route::prefix('{event_id}/activity')->group(function () { /** Rotas de Inscrição na Atividade */
            Route::get('show', 'ActivitiesController@atividades')->name('');
            Route::post('insc', 'EventsController@inscricaoEvento')->middleware('auth');

        });
            Route::get('{event_id}/certificate', 'UsersController@certificado')->name('');

        });

});
Route::get('/event/{id}/show', 'EventsController@detalhes')->middleware('auth');
Route::put('event/update/{id}', 'EventsController@update');
Route::put('inst/update/{id}', 'InstitutionsController@update');
Route::post('user/activity/insc', 'UsersController@inscricao');

Route::get('certificado/index', 'UsersController@certificado');
Route::post('register/user', 'UsersController@store')->name('register.user');

