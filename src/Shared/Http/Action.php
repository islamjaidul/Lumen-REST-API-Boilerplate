<?php

namespace Src\Shared\Http;

use Auth;
use Laravel\Lumen\Routing\Controller as BaseAction;

class Action extends BaseAction
{
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => Auth::user()
        ], 200);
    }
}
