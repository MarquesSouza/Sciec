<?php

namespace App\Http\Controllers;

use App\Entities\Activity;
use App\Entities\TypeActivity;
use App\Entities\UsersActivity;
use App\Transformers\ActivityTransformer;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ActivityCreateRequest;
use App\Http\Requests\ActivityUpdateRequest;
use App\Repositories\ActivityRepository;
use App\Validators\ActivityValidator;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;

/**
 * Class ActivitiesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ActivitiesController extends Controller
{
    /**
     * @var ActivityRepository
     */
    protected $repository;

    /**
     * @var ActivityValidator
     */
    protected $validator;

    /**
     * ActivitiesController constructor.
     *
     * @param ActivityRepository $repository
     * @param ActivityValidator $validator
     */
    public function __construct(ActivityRepository $repository, ActivityValidator $validator)
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
        $activities = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $activities,
            ]);
        }

        /*return view('activities.index', compact('activities'));*/
        return  $activities;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ActivityCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $activity = $this->repository->create($request->all());

            $response = [
                'message' => 'Activity created.',
                'data'    => $activity->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            return $activity;
            /*return redirect()->back()->with('message', $response['message']);*/
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            return $e;
            //return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($event,$id)
    {
        $activity = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $activity,
            ]);
        }

        /*return view('activities.show', compact('activity'));*/
        return $activity;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($event,$id)
    {
        $activity = $this->repository->find($id);
        return $activity;
        //return view('activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ActivityUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request,  $event_id,$id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $activity = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Activity updated.',
                'data'    => $activity->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            return $activity;
            /*return redirect()->back()->with('message', $response['message']);*/
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
    public function destroy(Request $request,$event, $id)
    {
        try {


            $status = $request->only('status');

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $deleted = $this->repository->update($status, $id);



            $response = [
                'message' => 'Activity deleted.',
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
    public function atividades()
    {



        /*return view('activities.show', compact('activity'));*/
        return (new ActivityTransformer())->transform($this->repository->find(1));
    }
    public  function cad(){

        $tipoAtividade= TypeActivity::all();
        return $tipoAtividade;
    }
    public function frequencia($event,$id,$ty_id){

        $userActivities = UsersActivity::all();
        $userActivity = $userActivities->where('activity_id','=',$id)->where('user_activity_types_id','=',$ty_id);
        foreach ($userActivity as $user){
            $user->user;
        }
        foreach ($userActivity as $user){
            $user->activity;
        }
        foreach ($userActivity as $user){
            $user->userActivityType;
        }
        return $userActivity;
    }


}
