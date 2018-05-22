<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Activity;

/**
 * Class ActivityTransformer.
 *
 * @package namespace App\Transformers;
 */
class ActivityTransformer extends TransformerAbstract
{
    /**
     * Transform the Activity entity.
     *
     * @param \App\Entities\Activity $model
     *
     * @return array
     */
    public function transform(Activity $model)
    {
        return [
            'id'         => (int) $model->id,
            'nome'=>$model->nome,
            'descricao'=>$model->descricao,
            'local'=>$model->local,
            'horas'=>$model->horas,
            'qtd_inscritos'=>$model->qtd_inscritos,
            'status'=>$model->status,
            'type_activity_id'=>$model->type_activity_id,
            'data_inicio'=>  date("d/m/Y",strtotime($model->data_inicio)),
            'hora_inicio'=>  date( "H:i:s",strtotime($model->data_inicio)),
            'data_conclusao'=>date("d/m/Y",strtotime($model->data_conclusao)),
            'hora_conclusao'=>  date( "H:i:s",strtotime($model->data_conclusao)),
           ];
    }
}
