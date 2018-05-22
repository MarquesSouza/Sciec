<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class ActivityValidator.
 *
 * @package namespace App\Validators;
 */
class ActivityValidator extends LaravelValidator
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
            'data_conclusao' => 'required|date', //arrumar data para conclusao so ser depois de data de inicio.
            'horas' => 'required',
            'qtd_inscritos' => 'required',

        ],
        ValidatorInterface::RULE_UPDATE => [
            'nome' => 'required|min:3|max:100',
            'descricao' => 'required|min:3|max:1000',
            'status' => 'required',
            'local' => 'required|min:3|max:1000',
            'data_inicio' => 'required|date',
            'data_conclusao' => 'required|date',
            'horas' => 'required',
            'qtd_inscritos' => 'required',
        ],
    ];
}
