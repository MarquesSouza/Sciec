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
        Route::put('detele/{id}', 'UserController@destroy')->name('');
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
            Route::put('detele/{id}', 'TypeActivitiesController@destroy')->name('');
        });
        Route::prefix('type_user')->group(function () { /** Rotas de Configuração tipo de users*/
            Route::get('cad', 'UserTypesController@cad')->name('');
            Route::post('store', 'UserTypesController@store')->name('');
            Route::get('index', 'UserTypesController@index')->name('');
            Route::get('edit/{id}', 'UserTypesController@edit')->name('');
            Route::get('show/{id}', 'UserTypesController@show')->name('');
            Route::get('show/', 'UserTypesController@show')->name('');
            Route::put('update/{id}', 'UserTypesController@update')->name('');
            Route::put('detele/{id}', 'UserTypesController@destroy')->name('');
        });
        Route::prefix('user_activity')->group(function () { /** Rotas de Configuração tipo usuario atividade, dentro do evento */
            Route::get('cad', 'UserActivityTypesController@cad')->name('');
            Route::post('store', 'UserActivityTypesController@store')->name('');
            Route::get('index', 'UserActivityTypesController@index')->name('');
            Route::get('edit/{id}', 'UserActivityTypesController@edit')->name('');
            Route::get('show/{id}', 'UserActivityTypesController@show')->name('');
            Route::get('show/', 'UserActivityTypesController@show')->name('');
            Route::put('update/{id}', 'UserActivityTypesController@update')->name('');
            Route::put('detele/{id}', 'UserActivityTypesController@destroy')->name('');
        });
    });
    Route::prefix('event')->group(function () { /** Rotas de Configuração */

    });
});
Route::prefix('orga')->group(function () {   /** Rotas do Organizador */
    Route::prefix('config')->group(function () { /** Rotas de Configuração */
        Route::get('edit', 'HomeController@index')->name('');
    });
});
Route::prefix('user')->group(function () {   /** Rotas do Usuario */
    Route::prefix('config')->group(function () { /** Rotas de Configuração */
        Route::get('edit', 'HomeController@index')->name('');
    });
});
