<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'=>'required|min:3|max:100',
            'email'=>'email|unique:users,email',
            'cpf'=>'required|cpf|unique:users,cpf',
            'password'=>'alpha_num|between:6,20|Confirmed',
            'password' => 'alpha_num|between:6,20',
            'celular'=>'required|celular_com_ddd',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Entities\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'cpf'=> $data['cpf'],
            'status'=>'1',
            'celular'=> $data['celular'],
            'remember_token' => str_random(10)
        ]);

        /*$dataform = $data['tipousuario'];
        $user->tipoUsuario()->sync($dataform);
        return $user;*/
    }
}
