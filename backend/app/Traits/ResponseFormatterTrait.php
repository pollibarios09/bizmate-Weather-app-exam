<?php

namespace App\Traits;

trait ResponseFormatterTrait
{

	/**
	 * @param array $responseData   
	 * @param string $message  
	 * @param int $code           
	 * @return mixed                    
	 */
	public function success(?array $responseData = [], ?string $message = 'Success', int $code = 200)
	{
		return response()->json(array_merge($responseData, [
			'message'	=> $message
		]), $code);
	}

	/**
	 * @param string $message 
	 * @param int $code    
	 * @return mixed               
	 */
	public function notFound(string $message = 'Not found', int $code = 404)
	{
		return response()->json([
			'message'	=> $message
		], $code);
	}

	/**
	 * @param string $message 
	 * @param int $code    
	 * @return mixed               
	 */
	public function error(string $message = 'Error', int $code = 500)
	{
		return response()->json([
			'message'	=> $message
		], $code);
	}

	/**
	 * @param array|null  $errors 
	 * @param int|integer $code   
	 * @return mixed              
	 */
	public function unprocessedEntity(?array $errors = null, int $code = 422)
	{
		return response()->json([
			'errors' => $errors
		], $code);
	}

}