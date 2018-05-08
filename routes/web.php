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

/*TESTE DE COMIT ROMULO*/

Route::get('/', function () {
    return view('welcome');

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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
        Route::get('cad', 'UserController@cad_user')->name('');
        Route::get('index', 'UserController@index')->name('');
        Route::post('store', 'UserController@store')->name('');
        Route::get('show/{id}', 'UserController@show')->name('');
        Route::get('show/', 'UserController@show')->name('');
        Route::put('delete/{id}', 'UserController@destroy')->name('');
        Route::get('edit/{id}', 'UserController@edit')->name('');
        Route::put('update/{id}', 'UserController@update')->name('');
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
            Route::put('update/{id}', 'TypeActivitiesController@update')->name('');
            Route::put('delete/{id}', 'TypeActivitiesController@destroy')->name('');
        });
        Route::prefix('type_user')->group(function () { /** Rotas de Configuração tipo de users*/
            Route::get('cad', 'UserTypesController@cad')->name('');
            Route::post('store', 'UserTypesController@store')->name('');
            Route::get('index', 'UserTypesController@index')->name('');
            Route::get('edit/{id}', 'UserTypesController@edit')->name('');
            Route::get('show/{id}', 'UserTypesController@show')->name('');
            Route::get('show/', 'UserTypesController@show')->name('');
            Route::put('update/{id}', 'UserTypesController@update')->name('');
            Route::put('delete/{id}', 'UserTypesController@destroy')->name('');
        });
        Route::prefix('user_activity')->group(function () { /** Rotas de Configuração tipo usuario atividade, dentro do evento */
            Route::get('cad', 'UserActivityTypesController@cad')->name('');
            Route::post('store', 'UserActivityTypesController@store')->name('');
            Route::get('index', 'UserActivityTypesController@index')->name('');
            Route::get('edit/{id}', 'UserActivityTypesController@edit')->name('');
            Route::get('show/{id}', 'UserActivityTypesController@show')->name('');
            Route::get('show/', 'UserActivityTypesController@show')->name('');
            Route::put('update/{id}', 'UserActivityTypesController@update')->name('');
            Route::put('delete/{id}', 'UserActivityTypesController@destroy')->name('');
        });
        Route::prefix('instution')->group(function () { /** Rotas de Configuração Instituição */
            Route::get('cad', 'InstitutionsController@cad')->name('');
            Route::post('store', 'InstitutionsController@store')->name('');
            Route::get('index', 'InstitutionsController@index')->name('');
            Route::get('edit/{id}', 'InstitutionsController@edit')->name('');
            Route::get('show/{id}', 'InstitutionsController@show')->name('');
            Route::get('show/', 'InstitutionsController@show')->name('');
            Route::put('update/{id}', 'InstitutionsController@update')->name('');
            Route::put('delete/{id}', 'InstitutionsController@destroy')->name('');
        });
    });
    Route::prefix('event')->group(function () { /** Rotas do Evento*/
        Route::get('cad', 'EventsController@cad')->name('');
        Route::post('store', 'EventsController@store')->name('');
        Route::get('index', 'EventsController@index')->name('');
        Route::get('edit/{id}', 'EventsController@edit')->name('');
        Route::get('show/{id}', 'EventsController@show')->name('');
        Route::get('show/', 'EventsController@show')->name('');
        Route::put('update/{id}', 'EventsController@update')->name('');
        Route::put('delete/{id}', 'EventsController@destroy')->name('');

        Route::prefix('{id}/activity')->group(function () { /** Rotas das Atividade */
            Route::get('cad', 'ActivitiesController@cad')->name('');
            Route::post('store', 'ActivitiesController@store')->name('');
            Route::get('index', 'ActivitiesController@index')->name('');
            Route::get('edit/{id}', 'ActivitiesController@edit')->name('');
            Route::get('show/{id}', 'ActivitiesController@show')->name('');
            Route::get('show/', 'ActivitiesController@show')->name('');
            Route::put('update/{id}', 'ActivitiesController@update')->name('');
            Route::put('delete/{id}', 'ActivitiesController@destroy')->name('');
            Route::prefix('{id}/frequency')->group(function () { /** Rotas das Frequencia */
                Route::get('show/', 'ActivitiesController@show')->name('');
                Route::put('update/{id}', 'ActivitiesController@update')->name('');
            });
        });
    });
});
Route::prefix('orga')->group(function () {   /** Rotas do Organizador */
    Route::prefix('event')->group(function () { /** Rotas do Evento*/
        Route::get('cad', 'EventsController@cad')->name('');
        Route::post('store', 'EventsController@store')->name('');
        Route::get('index', 'EventsController@index')->name('');
        Route::get('edit/{id}', 'EventsController@edit')->name('');
        Route::get('show/{id}', 'EventsController@show')->name('');
        Route::get('show/', 'EventsController@show')->name('');
        Route::put('update/{id}', 'EventsController@update')->name('');
        Route::put('delete/{id}', 'EventsController@destroy')->name('');

        Route::prefix('{id}/activity')->group(function () { /** Rotas das Atividade */
            Route::get('cad', 'ActivitiesController@cad')->name('');
            Route::post('store', 'ActivitiesController@store')->name('');
            Route::get('index', 'ActivitiesController@index')->name('');
            Route::get('edit/{id}', 'ActivitiesController@edit')->name('');
            Route::get('show/{id}', 'ActivitiesController@show')->name('');
            Route::get('show/', 'ActivitiesController@show')->name('');
            Route::put('update/{id}', 'ActivitiesController@update')->name('');
            Route::put('delete/{id}', 'ActivitiesController@destroy')->name('');
            Route::prefix('{id}/frequency')->group(function () { /** Rotas das Frequencia */
                Route::get('show/', 'ActivitiesController@show')->name('');
                Route::put('update/{id}', 'ActivitiesController@update')->name('');
            });
        });
    });
});
Route::prefix('user')->group(function () {   /** Rotas do Usuario */
    Route::prefix('event')->group(function () { /** Rotas de Usuario Evento */
        Route::get('show', 'EventsController@show')->name('');

        Route::prefix('{id}/activity')->group(function () { /** Rotas de Inscrição na Atividade */
            Route::get('show', 'ActivitiesController@show')->name('');
            Route::post('insc', 'ActivitiesController@insc')->name('');
        });
        Route::prefix('{id}/certificate')->group(function () { /** Rotas de Inscrição na Atividade */
            Route::get('show', 'ActivitiesController@show')->name('');

        });
    });

});
