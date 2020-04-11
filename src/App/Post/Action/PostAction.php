<?php

namespace Src\App\Post\Action;

use Src\Shared\Http\Action;
use Illuminate\Http\Request;
use Src\App\Post\Responder\PostResponder;
use Src\App\Post\Domain\Services\PostService;
use Illuminate\Validation\ValidationException;

class PostAction extends Action
{
	private $service;
	private $request;
	private $responder;

	public function __construct
	(
		Request $request,
		PostService $service,
		PostResponder $responder
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
	 * get single post
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
	 * save / update post
	 *
	 * @return json
	*/
	public function store()
	{
		try {
			$this->validate($this->request, [
                'user_id' => 'required',
                'category_id' => 'required',
                'featured_image' => 'required',
                'title' => 'required',
                'short_description' => 'required',
                'full_description' => 'required',
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
	 * delete post
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
