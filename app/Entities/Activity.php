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
        'status',
        'type_activities_id',
        'events_id'
    ];

    public function typeActivities(){
        return $this->belongsTo(TypeActivity::class, 'type_activities_id');
    }
    public function usuario(){
        return $this->belongsToMany(User::class, 'users_activities');
    }

    public function events(){
        return $this->belongsTo(Event::class, 'events_id');
    }
}
