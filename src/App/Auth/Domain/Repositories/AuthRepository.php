<?php

namespace Src\App\Auth\Domain\Repositories;

use Src\App\Auth\Domain\Model\User;

class AuthRepository
{
	private $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * store registration data
	 *
	 * @param $data
	 * @return bool
	*/
	public function store(array $data) : bool
	{
		return $this->user->fill($data) && $this->user->save();
	}
}