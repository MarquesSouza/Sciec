<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserActivityTypeCreateRequest;
use App\Http\Requests\UserActivityTypeUpdateRequest;
use App\Repositories\UserActivityTypeRepository;
use App\Validators\UserActivityTypeValidator;

/**
 * Class UserActivityTypesController.
 *
 * @package namespace App\Http\Controllers;
 */
class UserActivityTypesController extends Controller
{
    /**
     * @var UserActivityTypeRepository
     */
    protected $repository;

    /**
     * @var UserActivityTypeValidator
     */
    protected $validator;

    /**
     * UserActivityTypesController constructor.
     *
     * @param UserActivityTypeRepository $repository
     * @param UserActivityTypeValidator $validator
     */
    public function __construct(UserActivityTypeRepository $repository, UserActivityTypeValidator $validator)
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
        $userActivityTypes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userActivityTypes,
            ]);
        }

        return view('userActivityTypes.index', compact('userActivityTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserActivityTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UserActivityTypeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $userActivityType = $this->repository->create($request->all());

            $response = [
                'message' => 'UserActivityType created.',
                'data'    => $userActivityType->toArray(),
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
        $userActivityType = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userActivityType,
            ]);
        }

        return view('userActivityTypes.show', compact('userActivityType'));
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
        $userActivityType = $this->repository->find($id);

        return view('userActivityTypes.edit', compact('userActivityType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserActivityTypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UserActivityTypeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $userActivityType = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'UserActivityType updated.',
                'data'    => $userActivityType->toArray(),
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
                'message' => 'UserActivityType deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UserActivityType deleted.');
    }
}
