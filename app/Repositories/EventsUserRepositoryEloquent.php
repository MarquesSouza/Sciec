<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\events_userRepository;
use App\Entities\EventsUser;
use App\Validators\EventsUserValidator;

/**
 * Class EventsUserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EventsUserRepositoryEloquent extends BaseRepository implements EventsUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EventsUser::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return EventsUserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
