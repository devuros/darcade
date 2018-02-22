<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
	const HTTP_SUCCESS = 200;
	const HTTP_CREATED = 201;

	const HTTP_BAD_REQUEST = 400;
	const HTTP_UNAUTHORIZED = 401;
	const HTTP_FORBIDDEN = 403;
	const HTTP_NOT_FOUND = 404;
	const HTTP_CONFLICT = 409;
	const HTTP_UNPROCESSABLE_ENTITY = 422;

	const HTTP_INTERNAL_ERROR = 500;

	protected $statusCode;

	public function getStatusCode()
	{
		return $this->statusCode;
	}

	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
		return $this;
	}

	public function respond($data, $headers = [])
	{
		return response()->json($data, $this->getStatusCode(), $headers);
	}

	/**
	 * General method for responding with success
	 */
	public function respondWithSuccess($message)
	{
		return $this->respond([
			'message'=> $message,
		]);
	}

	/**
	 * Specific success method: HTTP_SUCCESS
	 */
	public function respondSuccess($message = 'OK')
	{
		return $this->setStatusCode(self::HTTP_SUCCESS)->respondWithSuccess($message);
	}

	/**
	 * Specific success method: HTTP_CREATED
	 */
	public function respondCreated($message = 'Resource created')
	{
		return $this->setStatusCode(self::HTTP_CREATED)->respondWithSuccess($message);
	}

	/**
	 * General method for responding with error
	 */
	public function respondWithError($message)
	{
		return $this->respond([
			'error'=> [
				'message'=> $message,
				'code'=> $this->getStatusCode()
			]
		]);
	}

	/**
	 * Specific error method: HTTP_BAD_REQUEST
	 */
	public function respondBadRequest($message = 'Malformed syntax')
	{
		return $this->setStatusCode(self::HTTP_BAD_REQUEST)->respondWithError($message);
	}

	/**
	 * Specific error method: HTTP_UNAUTHORIZED
	 */
	public function respondUnauthorized($message = 'Unauthorized')
	{
		return $this->setStatusCode(self::HTTP_UNAUTHORIZED)->respondWithError($message);
	}

	/**
	 * Specific error method: HTTP_FORBIDDEN
	 */
	public function respondForbidden($message = 'You don not have the permission')
	{
		return $this->setStatusCode(self::HTTP_FORBIDDEN)->respondWithError($message);
	}

	/**
	 * Specific error method: HTTP_NOT_FOUND
	 */
	public function respondNotFound($message = 'Resource not found')
	{
		return $this->setStatusCode(self::HTTP_NOT_FOUND)->respondWithError($message);
	}

	/**
	 * Specific error method: HTTP_CONFLICT
	 */
	public function respondConflict($message = 'Conflict, resource is not present')
	{
		return $this->setStatusCode(self::HTTP_CONFLICT)->respondWithError($message);
	}

	/**
	 * Specific error method: HTTP_UNPROCESSABLE_ENTITY
	 */
	public function respondUnprocessableEntity($message = 'Input failed validation')
	{
		return $this->setStatusCode(self::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
	}

	/**
	 * Specific error method: HTTP_INTERNAL_ERROR
	 */
	public function respondInternalError($message = 'Internal application error')
	{
		return $this->setStatusCode(self::HTTP_INTERNAL_ERROR)->respondWithError($message);
	}

	/**
	 * Method for responding with custom data
	 */
	public function respondCustom(array $data)
	{
		return $this->setStatusCode(self::HTTP_SUCCESS)->respond([
            'data'=> $data
        ]);
	}

}
