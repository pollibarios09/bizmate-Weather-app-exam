<?php
namespace App\Utilities\ModelHelper;

use Illuminate\Support\Arr;
use App\Utilities\ModelHelper\Abstract\ModelHelperAbstract;

class CityModelHelper extends ModelHelperAbstract 
{

    /**
     * prepareParameter function
     *
     * @param array|\Illuminate\Support\Collection $parameter
     * @return array
     */
    public function prepareParameter($parameter) 
    {
        $this->parameterChecker($parameter);

        $preparedParameter = [
            'weather_id' => Arr::get($parameter, 'weather_id') ?? Arr::get($parameter, 'id', 0),
            'name' => Arr::get($parameter, 'name'),
            'country' => Arr::get($parameter, 'country'),
        ];

        return $preparedParameter;

    }
}