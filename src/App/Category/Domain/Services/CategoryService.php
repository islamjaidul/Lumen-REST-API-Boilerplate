<?php

namespace Src\App\Category\Domain\Services;

use Illuminate\Support\Str;
use Src\App\Category\Domain\Repositories\CategoryRepository;

class CategoryService
{
	protected $categoryRepository;

	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
	}

	/**
	 * handle all
	 *
	 * @param $perPage
	 * @return object
	*/
	public function handleAll(int $perPage = 10) : object
	{
		return $this->categoryRepository->all($perPage);
	}

	/**
	 * handle store
	 *
	 * @param $payload
	 * @return obj
	*/
	public function handleStore(array $payload) : object
	{
		$payload = array_merge($payload, ['slug' => Str::slug($payload['name'])]);
		return $this->categoryRepository->store($payload);
	}

	/**
	 * handle find by id
	 * 
	 * @param $id
	 * @return obj
	*/
	public function handleFind(int $id) : object
	{
		return $this->categoryRepository->findById($id);
	}

	/**
	 * handle delete
	 *
	 * @param $id
	 * @return bool
	*/
	public function handleDelete(int $id) : bool
	{
		return $this->categoryRepository->deleteById($id);
	}
}