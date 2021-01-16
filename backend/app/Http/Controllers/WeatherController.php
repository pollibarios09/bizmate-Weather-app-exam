<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Services\Request\WeatherRequest;
use App\Traits\ResponseFormatterTrait;
use Carbon\Carbon;
use Exception;

class WeatherController extends Controller
{
    use ResponseFormatterTrait;
    /**
     * @var App\Services\Request\WeatherRequest
     */
    private $weatherRequest;

    /**
     * CityController constructor
     *
     * @param WeatherRequest $weatherRequest
     */
    public function __construct(
        WeatherRequest $weatherRequest
    ) {
        $this->weatherRequest = $weatherRequest;
    }

    /**
     * @param City $city
     * @return void
     */
    public function show(City $city)
    {
        try {
            $weatherList = $this->weatherRequest->show($city);

            return $this->success([
                'data' => $weatherList
            ]);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }
}
