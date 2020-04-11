<?php

namespace Src\App\Auth\Responder;

class AuthResponder
{
	public function respond(bool $status)
	{
		if ($status) {
			return response()->json([
				'status' => $status
			], 201);
		}

		return response()->json([
			'status' => $status
		], 409);
	}
}