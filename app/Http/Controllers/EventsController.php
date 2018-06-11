<?php

namespace App\Http\Controllers;

use App\Entities\Activity;
use App\Entities\Event;
use App\Entities\EventsUser;
use App\Entities\Institution;
use App\Entities\UsersActivity;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use App\Http\Requests;
//use Laravel\Passport\Bridge\User;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EventCreateRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Repositories\EventRepository;
use App\Validators\EventValidator;
/**
 * Class EventsController.
 *
 * @package namespace App\Http\Controllers;
 */
class EventsController extends Controller
{
    /**
     * @var EventRepository
     */
    protected $repository;

    /**
     * @var EventValidator
     */
    protected $validator;

    /**
     * EventsController constructor.
     *
     * @param EventRepository $repository
     * @param EventValidator $validator
     */
    public function __construct(EventRepository $repository, EventValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $events = $this->repository->all()->where('status','=','1');

        foreach ($events as $e){
           $e->institutions->nome;
        }

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $events,
            ]);
        }

        /*return view('events.index', compact('events'));*/
        return view('home.index', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EventCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $event = $this->repository->create($request->all());

            $response = [
                'message' => 'Event created.',
                'data'    => $event->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            return $event;
            /*return redirect()->back()->with('message', $response['message']);*/
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            return $e;
       //     return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $event,
            ]);
        }

        /*return view('events.show', compact('event'));*/
        return $event;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = $this->repository->find($id);

        /*return view('events.edit', compact('event'));*/
        return $event;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EventUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $event = $this->repository->update($request->all(), $id);



            $response = [
                'message' => 'Event updated.',
                'data'    => $event->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            return $event;
          //  return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            return $e;
           // return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {


            $status = $request->only('status');

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $deleted = $this->repository->update($status, $id);



            $response = [
                'message' => 'Event deleted.',
                'data' => $deleted->toArray(),

            ];
            if ($request->wantsJson()) {
                return response()->json($response);

            }
            return $response;
            //  return redirect()->back()->with('message', $response['message']);

        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return $e->getMessageBag();
        }
    }
    public  function cad(){

        $Institutions= Institution::all();
        return $Institutions;
    }

    /**
     * @param $event_id
     * @return array
     */
    public function inscricaoEvento(Request $request,$event_id)
    {
        $request->atividade;
        $id=Auth::user()->id;
        $event_user=EventsUser::all()->where('user_id','=',$id)->where('events_id','=',$event_id);
        if($event_user=='null'){
            $userEvent= EventsUser::create(['user_id'=>Auth::user()->id,'events_id'=>$id])->id;
                     dd($userEvent);
        }

        // etapa 1 colizao de atividades
        $atividade=Activity::all();
        $userActivi=new UsersActivity();
        $lista=$request->atividade;
        //dd();
        $colizoes[]="";
        $colizao=$userActivi->colisaoAtividade($event_id);
        foreach ($colizao as $item=>$value){
            $a=$atividade->find($item);
            for($i=0;$i<count($lista);$i++){
                $count=0;
                if($item==$lista[$i]){
                 $count++;
                       foreach ($value as $inde=>$item2){
                           $b=$atividade->find($item2);
                           for($i=0;$i<count($lista);$i++) {
                               if($item2==$lista[$i]){
                                   $count++;                            }
                               if($count>1){
                               $colizoes[]= $a->nome." <br>" . $b->nome. "<br> Atividades ocorrem nas mesma data ou horario!<br> Escolha apenas uma!";
                                   $sucesso = "false";
                                   return view('events.concluido', compact('sucesso','colizoes'));
                                }
                           }
                       }
                }
            }
        }
        if($colizoes[0]==""){
            // etapa 1 se ja esta inscritos
            for($i=0;$i<count($lista);$i++){
            $ativi_user=UsersActivity::all()->where('user_id','=',$id)->where('activity_id','=',$lista[$i]);
          //  dd($ativi_user);
                if($ativi_user=='null'){
                    $atividade_user=UsersActivity::create(['user_id'=>Auth::user()->id,'activity_id'=>$lista[$i],'presenca'=>0,'user_activity_types_id'=>1]);
                    $sucesso = "true";
                    return view('events.concluido', compact('sucesso','colizoes'));
                }
                $sucesso = "true";
                return view('events.concluido', compact('sucesso','colizoes'));
            }


        }


    }
    public function detalhes($id)
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $event = $this->repository->find($id);
        $atividade= Activity::all()->where('events_id','=',$id);
      //  dd($atividade);

                /*return view('events.index', compact('events'));*/
       if($event->status==1){
        return view('home.atividade', compact('event','atividade'));
    }else{
           return redirect('home');
       }
    }
}
