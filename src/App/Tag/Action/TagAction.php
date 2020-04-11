<?php

namespace Src\App\Tag\Action;

use Src\Shared\Http\Action;
use Illuminate\Http\Request;
use Src\App\Tag\Responder\TagResponder;
use Src\App\Tag\Domain\Services\TagService;
use Illuminate\Validation\ValidationException;

class TagAction extends Action
{
	private $service;
	private $request;
	private $responder;

	public function __construct
	(
		Request $request,
		TagService $service,
		TagResponder $responder
	)
	{
		$this->request      = $request;
		$this->service 		= $service;
		$this->responder 	= $responder;
	}

	/**
	 * get all categories
	 *
	 * @return json
	*/
	public function all()
	{
		try {
			return $this->responder
			->respondAll(
				$this->service->handleAll()
			);
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * get single tag
	 *
	 * @return json
	*/
	public function find(int $id)
	{
		try {
			return $this->responder
			->respondFind(
				$this->service->handleFind($id)
			);
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * save / update tag
	 *
	 * @return json
	*/
	public function store()
	{
		try {
			$this->validate($this->request, [
                'name' => 'required'
            ]);

			$this->service->handleStore($this->request->all());
			return $this->responder->respondStore();
		} catch (\Exception $e) {
			if ($e instanceof ValidationException) {
				return $this->responder
				->respondStoreWithException($e->errors());
			}

			return $e->getMessage();
		}
	}

	/**
	 * delete tag
	*/
	public function delete(int $id)
	{
		try {
			return $this->responder
			->respondDelete(
				$this->service->handleDelete($id)
			);
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
}
