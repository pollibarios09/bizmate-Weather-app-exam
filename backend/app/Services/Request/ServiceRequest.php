<?php
namespace App\Services\Request;

use Illuminate\Support\Arr;
use App\Utilities\RequestHandler;

class ServiceRequest
{
    
	/**
	 * @var RequestHandler
	 */
    private $requestHandler;

    /**
	 * @var \GuzzleHttp\Psr7\Response
	 */
    public $response;

    /**
	 * @param RequestHandler $requestHandler 
	 */
    public function __construct(RequestHandler $requestHandler) 
    {
        $this->requestHandler = $requestHandler;
	}

    /**
     * handle function
     *
     * @param string $method
     * @param array $payload
     * @param array $header
     * @return void
     */
    private function handle($method, array $payload = [], $header = []) 
    {
        $this->response = $this->requestHandler
            ->setRequestUrl($this->url)
            ->setHeader($header)
            ->setBody($payload)
            ->execute($method);

        return $this;
    }

    /**
     * requestGet function
     *
     * @param string|array $queryParams
     * @param array $payload
     * @param array $header
     * @return $this
     */
    public function requestGet($queryParams, array $payload = [], $header = []) 
    {
        if (is_array($queryParams)) {
            $queryParams = "?" . Arr::query($queryParams);
        }

        $this->url .= $queryParams;

        return $this->handle('get', $payload, $header);
    }

    /**
     * requestPost function
     *
     * @param array $payload
     * @param array $header
     * @return this
     */
    public function requestPost(array $payload, $header = []) 
    {
        return $this->handle('post', $payload, $header);
    }


    /**
     * @param string $format should be Array|Collection
     * @return arry|Collection
     */
    public function get($format = 'Array')
    {
        return $this->response->{"to{$format}"}();
    }
}