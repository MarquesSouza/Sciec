<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\User_activity_typeRepository;
use App\Entities\UserActivityType;
use App\Validators\UserActivityTypeValidator;

/**
 * Class UserActivityTypeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserActivityTypeRepositoryEloquent extends BaseRepository implements UserActivityTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserActivityType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UserActivityTypeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
