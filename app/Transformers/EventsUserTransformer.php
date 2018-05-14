<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\EventsUser;

/**
 * Class EventsUserTransformer.
 *
 * @package namespace App\Transformers;
 */
class EventsUserTransformer extends TransformerAbstract
{
    /**
     * Transform the EventsUser entity.
     *
     * @param \App\Entities\EventsUser $model
     *
     * @return array
     */
    public function transform(EventsUser $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
