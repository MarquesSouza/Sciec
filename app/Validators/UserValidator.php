<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator.
 *
 * @package namespace App\Validators;
 */
class UserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome'=>'required|min:3|max:100',
            'email'=>'email|unique:users,email',
            'cpf'=>'required|cpf|unique:users,cpf',
            'senha'=>'alpha_num|between:6,20|Confirmed',
            'senha' => 'alpha_num|between:6,20',
            'celular'=>'required|celular_com_ddd',
             ],
        ValidatorInterface::RULE_UPDATE => [
            'nome'=>'required|min:3|max:100',
            'senha'=> 'alpha_num|between:6,20|Confirmed',
            'senha' => 'alpha_num|between:6,20',
            'email'=>'email|unique:users,email',
            'celular'=>'required|celular_com_ddd',
        ],
    ];
}
