<?php

namespace Src\App\Auth\Action;

use Auth;
use Tymon\JWTAuth\JWTAuth;
use Src\Shared\Http\Action;
use Illuminate\Http\Request;
use Src\App\Auth\Responder\AuthResponder;
use Src\App\Auth\Domain\Services\AuthService;
use Illuminate\Validation\ValidationException;

class AuthAction extends Action
{
    private $auth;
    private $service;
    private $request;
    private $responder;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct
    (
        JWTAuth $auth,
        Request $request, 
        AuthService $service,
        AuthResponder $responder
    )
    {
        $this->auth         = $auth;
        $this->service      = $service;
        $this->request      = $request;
        $this->responder    = $responder;
    }

    /**
     * handle registration request
     *
     * @return json
    */
    public function register()
    {   
        try {
            $this->validate($this->request, [
                'first_name' => 'required|max:100',
                'last_name'  => 'required|max:100',
                'email'      => 'required|max:100|unique:users,email',
                'password'   => 'required|min:6'
            ]);
            
            $serviceResponse = $this->service
            ->handleRegistration($this->request->all());

            return $this->responder
            ->respond($serviceResponse);
        } catch(ValidationException $exception) {
            return response()->json([
                'status' => false,
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    /**
     * handle login request
     *
     * @return json
    */
    public function login()
    {
        try {
            if ($this->request->wantsJson()) {
                //validate incoming request 
                $this->validate($this->request, [
                    'email' => 'required|string',
                    'password' => 'required|min:6|max:50|string',
                ]);

                $credentials = $this->request->only(['email', 'password']);

                if (! $token = Auth::attempt($credentials)) {
                    return response()
                    ->json(['message' => 'Unauthorized'], 401);
                }

                return $this->respondWithToken($token);
            }
        } catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    /**
     * handle logout
     *
     * @return json
    */
    public function logout()
    {
        $this->auth->invalidate();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * get auth info
     *
     * @return json
    */
    public function authUserInfo()
    {
        return response()->json([
            'success' => true,
            'data' => $this->request->user()
        ]);
    }
}
