<?php

namespace App\Http\Controllers;

use App\Entities\UserType;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserTypeCreateRequest;
use App\Http\Requests\UserTypeUpdateRequest;
use App\Repositories\UserTypeRepository;
use App\Validators\UserTypeValidator;

/**
 * Class UserTypesController.
 *
 * @package namespace App\Http\Controllers;
 */
class UserTypesController extends Controller
{
    /**
     * @var UserTypeRepository
     */
    protected $repository;

    /**
     * @var UserTypeValidator
     */
    protected $validator;

    /**
     * UserTypesController constructor.
     *
     * @param UserTypeRepository $repository
     * @param UserTypeValidator $validator
     */
    public function __construct(UserTypeRepository $repository, UserTypeValidator $validator)
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
        $userTypes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userTypes,
            ]);
        }

        //return view('userTypes.index', compact('userTypes'));
        return $userTypes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $userType = $this->repository->create($request->all());

            $response = [
                'message' => 'UserType created.',
                'data'    => $userType->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            return $response;
//            return redirect()->back()->with('message', $response['message']);
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
    public function show($id)
    {
        $userType = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userType,
            ]);
        }
        return $userType;
        //return view('userTypes.show', compact('userType'));
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
        $userType = $this->repository->find($id);
        return $userType;
       // return view('userTypes.edit', compact('userType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserTypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UserTypeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $userType = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'UserType updated.',
                'data'    => $userType->toArray(),
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
            return $e;
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
    public function destroy(Request $request, $id)
    {
        try {


            $status = $request->only('status');

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $deleted = $this->repository->update($status, $id);



            $response = [
                'message' => 'UserType deleted.',
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
}
