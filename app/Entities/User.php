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
                            'telefone',
                            'status',
                            'remember_token',
    ];
    protected $hidden = [
                            'password',
                            'remember_token',
    ];

    public function tipoUser(){
        return $this->belongsToMany(UserType::class,'user_type_users','user_id','user_type_id');
    }
}
