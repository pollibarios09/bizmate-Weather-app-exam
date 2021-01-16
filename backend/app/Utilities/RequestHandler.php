<?php

namespace App\Utilities;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class RequestHandler
{

	/**
	 * @var array
	 */
	public $body;

	/**
	 * @var array
	 */
	public $headers;

	/**
	 * @var mixed
	 */
	public $result;

	/**
	 * @var string
	 */
	public $url;

	/**
	 * @var mixed
	 */
	public $response;

	/**
	 * @param string $url 
	 * @return self
	 */
	public function setRequestUrl($url)
	{
		$this->url = $url;
		return $this;
	}

	/**
	 * @param array $requestParameters
	 * @return self
	 */
	public function setBody(array $body)
	{
		$this->body = $body;
		return $this;
	}


	/**
	 * @param array $header
	 * @return self
	 */
	public function setHeader(array $header)
	{
		$this->header = $header;
		return $this;
	}

	/**
	 * @param string $method
	 * @return mixed
	 */
	public function execute($method)
	{
		$client = new Client;

		$options = [
			'json'	=> $this->body
		];

		if (!empty($this->header)) {
			$options = array_merge($options, [
				'headers' => $this->header
			]);
		}

		$this->response = $client->{$method}($this->url, $options);
		return $this;
	}


	/**
	 * @return array
	 */
	public function toArray()
	{
		if ($this->response instanceOf \GuzzleHttp\Psr7\Response) {
			return json_decode($this->response->getBody()->getContents(), true);
        }
        
		return [];
    }
    
    /**
	 * @return Collection
	 */
	public function toCollection()
	{
        return collect($this->toArray());
	}


	/**
	 * @return mixed
	 */
	public function getResponse(){
		return $this->response;
	}

}