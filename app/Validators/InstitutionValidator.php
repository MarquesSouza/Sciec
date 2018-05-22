<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class InstitutionValidator.
 *
 * @package namespace App\Validators;
 */
class InstitutionValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|min:3|max:100',
            'descricao' => 'required|min:3|max:1000',
            'status' => 'required',
            'email'=>'email|unique:users,email',
            'telefone'=>'required|telefone_com_ddd',
            'site'=>'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|min:3|max:100',
            'descricao' => 'required|min:3|max:1000',
            'status' => 'required',
            'email'=>'email|unique:users,email',
            'telefone'=>'required|telefone_com_ddd',
            'site'=>'required'
        ],
    ];
}
