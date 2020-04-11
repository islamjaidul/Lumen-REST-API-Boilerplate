<?php

namespace Src\Shared\Http;

use Src\Shared\Http\Action;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection; 


abstract class ApiResponder extends Action
{
	protected $statusCode = 200;

    const CODE_FORBIDDEN = 'GEN-GTFO';
	const CODE_WRONG_ARGS = 'GEN-FUBARGS';
    const CODE_NOT_FOUND = 'GEN-LIKETHEWIND';
    const CODE_INTERNAL_ERROR = 'GEN-AAAGGH';
    const CODE_UNAUTHORIZED = 'GEN-MAYBGTFO';

	public function __construct(Manager $fractal)
	{
		$this->fractal = $fractal;
	}

	protected function getStatusCode()
	{
		return $this->statusCode;
	}

	protected function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
	}

	protected function respondWithItem(object $item, object $callback) 
	{
		$resource = new Item($item, $callback);
		$rootScope = $this->fractal->createData($resource);

		return $this->respond($rootScope->toArray()); 
	}

	protected function respondWithCollection(object $collection, object $callback) : object
	{
		$resource = new Collection($collection, $callback);
        $rootScope = $this->fractal->createData($resource);

		return $this->respond($rootScope->toArray()); 
	}

	protected function respond(array $array = [], array $headers = []) : object
	{
		return response()
        ->json($array, $this->statusCode, $headers);
	}

	protected function respondWithError($message, $errorCode)
    {
        if ($this->statusCode === 200) {
            trigger_error(
                "You better have a really good reason for erroring on a 200...",
                E_USER_WARNING
            );
        }
        return $this->respond([
            'error' => [
                'code' => $errorCode,
                'http_code' => $this->statusCode,
                'message' => $message,
            ]
        ]);
    }

    protected function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)
          ->respondWithError($message, self::CODE_FORBIDDEN);
    }

    protected function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)
          ->respondWithError($message, self::CODE_INTERNAL_ERROR);
    }

    protected function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)
          ->respondWithError($message, self::CODE_NOT_FOUND);
    }

    protected function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)
          ->respondWithError($message, self::CODE_UNAUTHORIZED);
    }
    
    protected function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(400)
          ->respondWithError($message, self::CODE_WRONG_ARGS);
    }
    
}