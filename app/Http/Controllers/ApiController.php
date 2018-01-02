<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{

	const http_success = 200; //	The standard success code and default option
	const http_created = 201; //	Resource created

	const http_bad_request = 400; //	Could not be understood due to malformed syntax
	const http_unauthorized = 401; //	User did not authenticate
	const http_forbidden = 403; //	Does not have the permission
	const http_not_found = 404; //	Resource not found

	const http_internal_error = 500; // Do not let this happen

	protected $statusCode;

	/**
	 *
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Getter for statusCode
	 */
	public function getStatusCode()
	{

		return $this->statusCode;

	}

	/**
	 * Setter for statusCode
	 */
	public function setStatusCode($statusCode)
	{

		$this->statusCode = $statusCode;
		return $this;

	}

	/**
	 * General method used by all responses
	 */
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
	 * Specific success method: http_success
	 */
	public function respondSuccess($message = 'OK')
	{

		return $this->setStatusCode(self::http_success)->respondWithSuccess($message);

	}

	/**
	 * Specific success method: http_created
	 */
	public function respondCreated($message = 'Resource created')
	{

		return $this->setStatusCode(self::http_created)->respondWithSuccess($message);

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
	 * Specific error method: http_bad_request
	 */
	public function respondBadRequest($message = 'Malformed syntax')
	{

		return $this->setStatusCode(self::http_bad_request)->respondWithError($message);

	}

	/**
	 * Specific error method: http_not_found
	 */
	public function respondNotFound($message = 'Resource not found')
	{

		return $this->setStatusCode(self::http_not_found)->respondWithError($message);

	}

	/**
	 * Specific error method: http_internal_error
	 */
	public function respondInternalError($message = 'Internal error')
	{

		return $this->setStatusCode(self::http_internal_error)->respondWithError($message);

	}

}
