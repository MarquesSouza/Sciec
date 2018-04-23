<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use function GuzzleHttp\Promise\all;

class AdminAuthentic
{
    public function handle($request, Closure $next, $guard=null)
    {
        if (Auth::guard($guard)->check()){ //Se Logado
        $user=new User();                   //Instancia classe usuario
        $user->id=Auth::user()->id;         //Set o id do objeto usuario
        $tipo=$user->tipoUser()->get()->all(); //consulta tipo usuario pegando do id do usuario
        foreach ($tipo as $t){                  //Percorre os retorno e armazena o id
            $tipouser=$t->id;
        }
    if(isset($tipouser)) {      //Se tem id
        if (($tipouser == 2) || ($tipouser == 3)) { //Se id organizador ou admin 2 ou 3
        }else {
            return redirect('home'); //Se nao e admin ou organizador vai pra home
        };
    }else{
            return redirect('home'); //Se nao tem id vai pra home
    }
    };
    return $next($request);
    }
}
