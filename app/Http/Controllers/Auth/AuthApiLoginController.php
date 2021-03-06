<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AuthApiLoginController extends Controller
{
    use AuthenticatesUsers;


    protected function authenticated(Request $request, User $user)
    {
        // implement your user role retrieval logic, for example retrieve from `roles` database table
        $user = $user->where('email', $request->username)->get()->first();

        $tipo =  $user->tipoUsuario;

        foreach ($tipo as $t){
            $t = $t->pivot->user_id;
        }



        // grant scopes based on the role that we get previously
        if ($t == 1) {
            $request->request->add([
                'scope' => 'administrador' // grant manage order scope for user with admin role
            ]);
        } else {
            $request->request->add([
                'scope' => 'participante' // read-only order scope for other user role
            ]);
        }

        // forward the request to the oauth token request endpoint
        $tokenRequest = Request::create(
            '/oauth/token',
            'post'
        );
        return Route::dispatch($tokenRequest);
    }

    protected function unauthenticated(Request $request,  User $user)
    {
        $dataform = $request->all();
        $user = $user->create($dataform);

        $this->guard()->login($user);


        $tokenRequest = Request::create(
            '/oauth/clients',
            'post'
        );

        return Route::dispatch($tokenRequest);
    }

}
