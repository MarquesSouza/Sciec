<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class EventValidator.
 *
 * @package namespace App\Validators;
 */
class EventValidator extends LaravelValidator
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
            'local' => 'required|min:3|max:1000',
            'data_inicio' => 'required|date',
            'data_conclusao' => 'required|date',
            'horas' => 'required',
            'situacao' => 'required',
            'coordenador' => 'required|min:3|max:100',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|min:3|max:100',
            'descricao' => 'required|min:3|max:1000',
            'status' => 'required',
            'local' => 'required|min:3|max:1000',
            'data_inicio' => 'required|date',
            'data_conclusao' => 'required|date',
            'horas' => 'required',
            'situacao' => 'required',
            'coordenador' => 'required|min:3|max:100',
        ],
    ];
}
