<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\users_activityRepository;
use App\Entities\UsersActivity;
use App\Validators\UsersActivityValidator;

/**
 * Class UsersActivityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UsersActivityRepositoryEloquent extends BaseRepository implements UsersActivityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UsersActivity::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UsersActivityValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
