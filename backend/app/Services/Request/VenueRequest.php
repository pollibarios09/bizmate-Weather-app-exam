<?php
namespace App\Services\Request;

use Carbon\Carbon;
use App\Models\City;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Utilities\RequestHandler;
use Illuminate\Support\Collection;
use App\Services\Request\ServiceRequest;

class VenueRequest extends ServiceRequest
{

    protected $url = 'https://api.foursquare.com/v2/venues/search';
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
    public function getList($city) {

        $payload = [
            'client_id' => env('FOURSQUARE_CLIENT_ID'),
            'client_secret' => env('FOURSQUARE_CLIENT_SECRET'),
            'v' => Carbon::now()->format('Ymd'),
            'query' => $city->name . ',' . $city->country,
            'll' => $city->coordinate->lat . ',' . $city->coordinate->long
        ];

        $response = $this->requestGet('?'. Arr::query($payload))->get();


        return Arr::get($response, 'response.venues');
    }
}