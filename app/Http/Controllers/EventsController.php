<?php

namespace App\Http\Controllers;

use App\Entities\Activity;
use App\Entities\Event;
use App\Entities\Institution;
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
       // if(Auth::check()){
        $request->atividade;
        $id=Auth::user()->id;
        $users =User::all();
        $user=$users->find($id);
        $user_evento = ['events_id'=>$event_id,'user_id'=>$id];

        dd($user->evento()->sync($user_evento));
       // }else{
       //    return redirect('login');
       // }
    }
    public function detalhes($id)
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $event = $this->repository->find($id);
        $atividade= Activity::all()->where('events_id','=',$id);
       // dd($atividade);

                /*return view('events.index', compact('events'));*/
       return view('home.atividade', compact('event','atividade'));
    }
}
