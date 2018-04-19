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
            'name'=>'required|min:3|max:100',
            'email'=>'email|unique:users,email',
            'cpf'=>'required|cpf|unique:users,cpf',
            'password'=>'alpha_num|between:6,20|Confirmed',
            'password' => 'alpha_num|between:6,20',
            'celular'=>'required|celular_com_ddd',
             ],
        ValidatorInterface::RULE_UPDATE => [
            'name'=>'required|min:3|max:100',
            'password'=> 'alpha_num|between:6,20|Confirmed',
            'password' => 'alpha_num|between:6,20',
            'email'=>'email|unique:users,email',
            'celular'=>'required|celular_com_ddd',
        ],
    ];
}
