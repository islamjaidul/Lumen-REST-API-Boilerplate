<?php

namespace Src\App\Tag\Domain\Services;

use Illuminate\Support\Str;
use Src\App\Tag\Domain\Repositories\TagRepository;

class TagService
{
	protected $tagRepository;

	public function __construct(TagRepository $tagRepository)
	{
		$this->tagRepository = $tagRepository;
	}

	/**
	 * handle all
	 *
	 * @param $perPage
	 * @return object
	*/
	public function handleAll(int $perPage = 10) : object
	{
		return $this->tagRepository->all($perPage);
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
			'slug' => Str::slug($payload['name'])
		]);

		return $this->tagRepository->store($payload);
	}

	/**
	 * handle find by id
	 * 
	 * @param $id
	 * @return obj
	*/
	public function handleFind(int $id) : object
	{
		return $this->tagRepository->findById($id);
	}

	/**
	 * handle delete
	 *
	 * @param $id
	 * @return bool
	*/
	public function handleDelete(int $id) : bool
	{
		return $this->tagRepository->deleteById($id);
	}
}