<?php

namespace Src\App\Media\Domain\Services;

use Illuminate\Support\Str;
use Src\App\Media\Domain\Repositories\MediaRepository;

class MediaService
{
	protected $mediaRepository;

	public function __construct(MediaRepository $mediaRepository)
	{
		$this->mediaRepository = $mediaRepository;
	}

	/**
	 * handle all
	 *
	 * @param $perPage
	 * @return object
	*/
	public function handleAll(int $perPage = 10) : object
	{
		return $this->mediaRepository->all($perPage);
	}

	/**
	 * handle store
	 *
	 * @param $payload
	 * @return obj
	*/
	public function handleStore(array $payload) : object
	{
		return $this->mediaRepository->store($payload);
	}

	/**
	 * handle find by id
	 * 
	 * @param $id
	 * @return obj
	*/
	public function handleFind(int $id) : object
	{
		return $this->mediaRepository->findById($id);
	}

	/**
	 * handle delete
	 *
	 * @param $id
	 * @return bool
	*/
	public function handleDelete(int $id) : bool
	{
		return $this->mediaRepository->deleteById($id);
	}
}