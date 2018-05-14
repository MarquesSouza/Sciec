<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\UsersActivity;

/**
 * Class UsersActivityTransformer.
 *
 * @package namespace App\Transformers;
 */
class UsersActivityTransformer extends TransformerAbstract
{
    /**
     * Transform the UsersActivity entity.
     *
     * @param \App\Entities\UsersActivity $model
     *
     * @return array
     */
    public function transform(UsersActivity $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
