<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Support\Facades\DB;

/**
 * Class UsersActivity.
 *
 * @package namespace App\Entities;
 */
class UsersActivity extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'activity_id',
        'presenca',
        'user_activity_types_id'
    ];
    public function activity(){
        return $this->belongsTo(Activity::class,'activity_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function userActivityType(){
        return $this->belongsTo(UserActivityType::class,'user_activity_types_id');
    }
    public function frequencia($activity_id,$user_activity_type){
        return 0;
    }
    public function colisaoAtividade($id_evento){
        $atividade = Activity::all();
        $activities = $atividade->where('events_id', '=', $id_evento);
        //dd($activities);
        $activitiesEspelho=$activities;
        foreach ($activities as $ativi){
            $dataIni = new \DateTime($ativi->data_inicio);
            $dataFim = new \DateTime($ativi->data_conclusao);
            if($ativi->status==1){
                foreach ($activitiesEspelho as $ativiEspelho){
                    $dataEspelhoIni = new \DateTime($ativiEspelho->data_inicio);
                    $dataEspelhoFim = new \DateTime($ativiEspelho->data_conclusao);
                    if(!(($dataIni>$dataEspelhoIni) && ($dataIni>$dataEspelhoFim)||
                            ($dataFim<$dataEspelhoIni) && ($dataFim<$dataEspelhoFim)
                        )&&($ativi->id<>$ativiEspelho->id)){
                        $data[]=$ativiEspelho->id;
                    }
                }
                if(!isset($data)){
                }else{
                    $colisao[$ativi->id]=$data;
                    unset($data);
                }
            };
        };
        return $colisao;
    }
}
