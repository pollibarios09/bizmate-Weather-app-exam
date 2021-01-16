<?php
namespace App\Utilities\ModelHelper;

use Illuminate\Support\Arr;
use App\Utilities\ModelHelper\Abstract\ModelHelperAbstract;

class CoodinateModelHelper extends ModelHelperAbstract
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
            'lat' => Arr::get($parameter, 'lat'),
            'long' => Arr::get($parameter, 'lon') ?? Arr::get($parameter, 'long'),
            'city_id' => Arr::get($parameter, 'city_id')
        ];

        return $preparedParameter;

    }
}