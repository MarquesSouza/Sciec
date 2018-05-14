<?php

namespace App\Presenters;

use App\Transformers\UsersActivityTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UsersActivityPresenter.
 *
 * @package namespace App\Presenters;
 */
class UsersActivityPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UsersActivityTransformer();
    }
}
