<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Resources\CityCollection;
use App\Services\Request\VenueRequest;
use App\Traits\ResponseFormatterTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CityController extends Controller
{
    use ResponseFormatterTrait;
    /**
     * @var App\Services\Request\VenueRequest
     */
    private $venueRequest;

    /**
     * CityController constructor
     *
     * @param VenueRequest $venueRequest
     */
    public function __construct(
        VenueRequest $venueRequest
    ) {
        $this->venueRequest = $venueRequest;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        try {
            $city = City::with('coordinate')
                        ->where('name', 'like', "%$request->name%")
                        ->paginate(10);

            return new CityCollection($city);

        } catch (ModelNotFoundException $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    /**
     * @param City $city
     * @return void
     */
    public function show(City $city)
    {
        try {
            $venueList = $this->venueRequest->getList($city);
            $city = $city->toArray();
            $city['venues'] = $venueList;

            return $this->success([
                'data' => $city
            ]);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }
}
