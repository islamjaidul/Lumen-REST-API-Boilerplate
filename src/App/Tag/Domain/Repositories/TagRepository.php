<?php

namespace Src\App\Tag\Domain\Repositories;

use Src\App\Tag\Domain\Model\Tag;

class TagRepository
{
	protected $model;

	public function __construct(Tag $model)
	{
		$this->model = $model;
	}

	/**
	 * all tags
	 *
	 * @param $perPage
	 * @return object 
	*/
	public function all(int $perPage) : object
	{
		return $this->model->paginate($perPage);
	}

	/**
	 * save / update tag
	 *
	 * @param $data
	 * @return object
	*/
	public function store(array $data) : object
	{
		return $this->model->store($data);
	}

	/**
	 * find tag by id
	 *
	 * @param $id
	 * @return object
	*/
	public function findById(int $id) : object
	{
		return $this->model->findOrFail($id);
	}

	/**
	 * delete tag by id
	 * 
	 * @param $id
	 * @return bool
	*/
	public function deleteById(int $id) : bool
	{
		$tag = $this->findById($id);
		return $tag->delete();
	}
}