<?php

namespace App\Entities;


use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Authenticatable implements Transformable
{
    use HasApiTokens,TransformableTrait,Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name',
                            'email',
                            'password',
                            'cpf',
                            'celular',
                            'status',
                            'remember_token',
    ];
    protected $hidden = [
                            'password',
                            'remember_token',
    ];


    public function tipoUsuario(){
        return $this->belongsToMany(UserType::class, 'user_type_users');
    }
    public function atividades(){
        return $this->belongsToMany(Activity::class, 'users_activities')->withPivot('presenca','user_activity_types_id');;
    }
    public function tipoUsuarioAtividade(){
        return $this->belongsToMany(UserActivityType::class, 'users_activities');
    }
    public function evento(){
        return $this->belongsToMany( Event::class,'events_users');
    }

}
