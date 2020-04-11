<?php

namespace Src\Shared\Http;

use Src\Shared\Http\ApiResponder;

abstract class BaseResponder extends ApiResponder
{
	public function respondAll(object $data)
	{
		return response()->json([
			'status' => true,
			'data' => $data
		]);
	}

	public function respondFind(object $data)
	{
		return response()->json([
			'status' => true,
			'data' => $data
		]);
	}

	public function respondDelete(bool $isDelete)
	{
		return response()->json([
			'status' => $isDelete
		]);
	}

	public function respondStore()
	{
		return response()->json([
			'status' => true
		]);
	}

	public function respondStoreWithException($errors)
	{
		return response()->json([
            'status' => false,
            'errors' => $errors,
        ], 422);
	}
}