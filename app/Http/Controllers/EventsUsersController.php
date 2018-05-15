<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EventsUserCreateRequest;
use App\Http\Requests\EventsUserUpdateRequest;
use App\Repositories\EventsUserRepository;
use App\Validators\EventsUserValidator;

/**
 * Class EventsUsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class EventsUsersController extends Controller
{
    /**
     * @var EventsUserRepository
     */
    protected $repository;

    /**
     * @var EventsUserValidator
     */
    protected $validator;

    /**
     * EventsUsersController constructor.
     *
     * @param EventsUserRepository $repository
     * @param EventsUserValidator $validator
     */
    public function __construct(EventsUserRepository $repository, EventsUserValidator $validator)
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
        $eventsUsers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $eventsUsers,
            ]);
        }
        return $eventsUsers;
       // return view('eventsUsers.index', compact('eventsUsers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EventsUserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EventsUserCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $eventsUser = $this->repository->create($request->all());

            $response = [
                'message' => 'EventsUser created.',
                'data'    => $eventsUser->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            return $response;
            //return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            return $e->getMessageBag();
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
    public function show($id)
    {
        $eventsUser = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $eventsUser,
            ]);
        }
        return $eventsUser;
        //return view('eventsUsers.show', compact('eventsUser'));
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
        $eventsUser = $this->repository->find($id);
        return $eventsUser;
        //return view('eventsUsers.edit', compact('eventsUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EventsUserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EventsUserUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $eventsUser = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'EventsUser updated.',
                'data'    => $eventsUser->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            return $response;
            //return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            return $e->getMessageBag();
            //return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'EventsUser deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'EventsUser deleted.');
    }
}
