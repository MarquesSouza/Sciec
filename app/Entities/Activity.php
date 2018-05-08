<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Activity.
 *
 * @package namespace App\Entities;
 */
class Activity extends Model implements Transformable
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
        'horas',
        'qtd_inscritos',
        'status'
    ];
    public function tipoAtividade(){
        return $this->belongsTo(TypeActivity::class, 'type_activities_id');
    }

    public function evento(){
        return $this->belongsTo(Event::class, 'events_id');
    }
}
