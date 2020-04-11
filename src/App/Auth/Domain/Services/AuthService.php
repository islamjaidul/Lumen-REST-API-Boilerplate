<?php

namespace Src\App\Auth\Domain\Services;

use Src\App\Auth\Domain\Repositories\AuthRepository;

class AuthService
{
	protected $authRepository;

	public function __construct(AuthRepository $authRepository)
	{
		$this->authRepository = $authRepository;
	}

	/**
	 * handle registration payload
	 *
	 * @param $payload
	 * @return bool
	*/
	public function handleRegistration(array $payload) : bool
	{
		return $this->authRepository->store($payload);
	}
}