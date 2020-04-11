<?php

namespace Src\App\Media\Domain\Repositories;

use Src\App\Media\Domain\Model\Media;

class MediaRepository
{
	protected $model;

	public function __construct(Media $model)
	{
		$this->model = $model;
	}

	/**
	 * all medias
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
		return $this->model
		->findOrFail($id);
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