<?php

namespace Src\App\Post\Domain\Services;

use Illuminate\Support\Str;
use Src\App\Post\Domain\Repositories\PostRepository;

class PostService
{
	protected $postRepository;

	public function __construct(PostRepository $postRepository)
	{
		$this->postRepository = $postRepository;
	}

	/**
	 * handle all
	 *
	 * @param $perPage
	 * @return object
	*/
	public function handleAll(int $perPage = 10) : object
	{
		return $this->postRepository->all($perPage);
	}

	/**
	 * handle store
	 *
	 * @param $payload
	 * @return obj
	*/
	public function handleStore(array $payload) : object
	{
		$payload = array_merge($payload, [
			'slug' => Str::slug($payload['title'])
		]);
		
		return $this->postRepository->store($payload);
	}

	/**
	 * handle find by id
	 * 
	 * @param $id
	 * @return obj
	*/
	public function handleFind(int $id) : object
	{
		return $this->postRepository->findById($id);
	}

	/**
	 * handle delete
	 *
	 * @param $id
	 * @return bool
	*/
	public function handleDelete(int $id) : bool
	{
		return $this->postRepository->deleteById($id);
	}
}