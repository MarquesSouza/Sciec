<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class UserType.
 *
 * @package namespace App\Entities;
 */
class UserType extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'nome',
                            'descricao',
                            'status',
    ];

    public function usuario(){
        return $this->belongsToMany(User::class, 'user_type_users');
    }

}
