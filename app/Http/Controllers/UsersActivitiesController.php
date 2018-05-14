<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UsersActivityCreateRequest;
use App\Http\Requests\UsersActivityUpdateRequest;
use App\Repositories\UsersActivityRepository;
use App\Validators\UsersActivityValidator;

/**
 * Class UsersActivitiesController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersActivitiesController extends Controller
{
    /**
     * @var UsersActivityRepository
     */
    protected $repository;

    /**
     * @var UsersActivityValidator
     */
    protected $validator;

    /**
     * UsersActivitiesController constructor.
     *
     * @param UsersActivityRepository $repository
     * @param UsersActivityValidator $validator
     */
    public function __construct(UsersActivityRepository $repository, UsersActivityValidator $validator)
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
        $usersActivities = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $usersActivities,
            ]);
        }

        return view('usersActivities.index', compact('usersActivities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UsersActivityCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UsersActivityCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $usersActivity = $this->repository->create($request->all());

            $response = [
                'message' => 'UsersActivity created.',
                'data'    => $usersActivity->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
        $usersActivity = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $usersActivity,
            ]);
        }

        return view('usersActivities.show', compact('usersActivity'));
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
        $usersActivity = $this->repository->find($id);

        return view('usersActivities.edit', compact('usersActivity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UsersActivityUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UsersActivityUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $usersActivity = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'UsersActivity updated.',
                'data'    => $usersActivity->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
                'message' => 'UsersActivity deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UsersActivity deleted.');
    }
}
