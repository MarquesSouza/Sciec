<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Event.
 *
 * @package namespace App\Entities;
 */
class Event extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'descricao',
        'local',
        'data_inicio',
        'data_conclusao',
        'situacao',
        'status',
        'institutions_id',
        'coordenador'

    ];
    public function institutions(){
        return $this->belongsTo(Institution::class,'institutions_id');
    }
}
