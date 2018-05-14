<?php

namespace App\Presenters;

use App\Transformers\EventsUserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EventsUserPresenter.
 *
 * @package namespace App\Presenters;
 */
class EventsUserPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EventsUserTransformer();
    }
}
