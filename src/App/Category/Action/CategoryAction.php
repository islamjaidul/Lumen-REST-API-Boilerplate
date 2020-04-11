<?php

namespace Src\App\Category\Action;

use Src\Shared\Http\Action;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Src\App\Category\Responder\CategoryResponder;
use Src\App\Category\Domain\Services\CategoryService;

class CategoryAction extends Action
{
	private $service;
	private $request;
	private $responder;

	public function __construct
	(
		Request $request,
		CategoryService $service,
		CategoryResponder $responder
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
	 * get single category
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
	 * save / update category
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
	 * delete category
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
