<?php

namespace App\Http\Controllers;

use App\Entities\Activity;
use App\Entities\EventsUser;
use App\Entities\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*  $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
          $users = $this->repository->all();

          if (request()->wantsJson()) {

              return response()->json([
                  'data' => $users,
              ]);
          }

          return view('users.index', compact('users'));*/
        return "user admin";
    }

    public function teste()
    {
        /*  $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
          $users = $this->repository->all();

          if (request()->wantsJson()) {

              return response()->json([
                  'data' => $users,
              ]);
          }

          return view('users.index', compact('users'));*/
        return "user participante";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $request['password']= bcrypt($request->input('password'));
            $user = $this->repository->create($request->all());

            /*$dataform = $request['tipousuario'];
            $user->tipoUsuario()->sync($dataform);*/


            $response = [
                'message' => 'User created.',
                'data' => $user->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }


            return redirect('/')->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
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
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }
        return $user;
        //return view('users.show', compact('user'));
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
        $user = $this->repository->find($id);
        return $user;
       // return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request, $id)
    {

        try {
            $dataForm = $request->all();
            if( isset($dataForm['email']) )
                unset($dataForm['email']);
            if( isset($dataForm['cpf']) )
                unset($dataForm['cpf']);
            if( isset($dataForm['password']) )
                unset($dataForm['password']);

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $user = $this->repository->update($dataForm, $id);

            $dataform = $request['tipousuario'];
            $user->tipoUsuario()->sync($dataform);

            $response = [
                'message' => 'User updated.',
                'data' => $user->toArray(),

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
                'message' => 'User deleted.',
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


//    public function certificado(Request $request,$event_id){
//        $user_id =2; //\Auth::guard('api')->user();
//        $EventUser=EventsUser::all();
//        $user=$EventUser->where('user_id','=', $user_id)->where('events_id','=',$event_id);
//        foreach ($user as $u){
//            $u->evento;
//        }
//        foreach ($user as $u){
//            $u->usuario;
//        }
//        return $user;
//    }


    public function certificado()
    {
        return view('certificado.certificado', compact('certificado'));
    }

}
