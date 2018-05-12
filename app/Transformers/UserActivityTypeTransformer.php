<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\UserActivityType;

/**
 * Class UserActivityTypeTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserActivityTypeTransformer extends TransformerAbstract
{
    /**
     * Transform the UserActivityType entity.
     *
     * @param \App\Entities\UserActivityType $model
     *
     * @return array
     */
    public function transform(UserActivityType $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
