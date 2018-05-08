<?php

namespace App\Presenters;

use App\Transformers\UserActivityTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UserActivityTypePresenter.
 *
 * @package namespace App\Presenters;
 */
class UserActivityTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserActivityTypeTransformer();
    }
}
