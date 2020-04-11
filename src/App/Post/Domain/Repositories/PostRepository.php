<?php

namespace Src\App\Post\Domain\Repositories;

use Src\App\Post\Domain\Model\Post;

class PostRepository
{
	protected $model;

	public function __construct(Post $model)
	{
		$this->model = $model;
	}

	/**
	 * all posts
	 *
	 * @param $perPage
	 * @return object 
	*/
	public function all(int $perPage) : object
	{
		return $this->model
		->paginate($perPage);
	}

	/**
	 * save / update category
	 *
	 * @param $data
	 * @return object
	*/
	public function store(array $data) : object
	{
		return $this->model->store($data);
	}

	/**
	 * find category by id
	 *
	 * @param $id
	 * @return object
	*/
	public function findById(int $id) : object
	{
		return $this->model->findOrFail($id);
	}

	/**
	 * delete category by id
	 * 
	 * @param $id
	 * @return bool
	*/
	public function deleteById(int $id) : bool
	{
		$category = $this->findById($id);
		return $category->delete();
	}
}