<?php

namespace Src\App\Post\Responder;

use Src\Shared\Http\ApiResponder;
use Src\App\Post\Responder\Transformers\PostTransformer;
use Src\App\Post\Responder\Transformers\SinglePostTransformer;

class PostResponder extends ApiResponder
{
	public function respondAll(object $collection)
	{
		return $this
		->respondWithCollection($collection, new PostTransformer)
		->setStatusCode(200);
	}

	public function respondFind(object $item) 
	{
		return $this
		->respondWithItem($item, new SinglePostTransformer)
		->setStatusCode(200);
	}

	public function respondDelete(bool $isDelete)
	{
		if ($isDelete) {
			return $this
			->respond(['status' => true])
			->setStatusCode(304);
		}

		return $this
			->respond(['status' => false])
			->setStatusCode(400);
	}

	public function respondStore()
	{
		return $this
		->respond(['status' => true])
		->setStatusCode(201);
	}
}