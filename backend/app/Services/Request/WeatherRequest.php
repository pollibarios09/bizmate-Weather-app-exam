<?php
namespace App\Services\Request;

use Carbon\Carbon;
use App\Models\City;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Utilities\RequestHandler;
use Illuminate\Support\Collection;
use App\Services\Request\ServiceRequest;

class WeatherRequest extends ServiceRequest
{

    protected $url = 'api.openweathermap.org/data/2.5/forecast';
    /**
     * VenueRequest constructor
     */
    public function __construct(
        RequestHandler $requestHandler
    ) {
        parent::__construct($requestHandler);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function show($city) {

        $request = [
            'appid' => env('OPENWEATHERMAP_APP_ID'),
            'id' => $city->weather_id,
            'units' => 'metric',
            'cnt' => 5
        ];

        $response = $this->requestGet('?'. Arr::query($request))->get();

        return Arr::get($response, 'list');
    }
}