<?php

namespace Src\App\Media\Action;

use Src\Shared\Http\Action;
use Illuminate\Http\Request;
use Src\App\Media\Responder\MediaResponder;
use Illuminate\Validation\ValidationException;
use Src\App\Media\Domain\Services\MediaService;

class MediaAction extends Action
{
	private $service;
	private $request;
	private $responder;

	public function __construct
	(
		Request $request,
		MediaService $service,
		MediaResponder $responder
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
	 * get single media
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
	 * save / update media
	 *
	 * @return json
	*/
	public function store()
	{
		try {
			$this->validate($this->request, [
                'full_url' => 'required',
                'thumbnail_url' => 'required'
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
	 * delete media
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
