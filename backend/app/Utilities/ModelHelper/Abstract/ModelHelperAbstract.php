<?php

namespace App\Utilities\ModelHelper\Abstract;

use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

abstract class ModelHelperAbstract {

    abstract public function prepareParameter($parameter);

    /**
     * Undocumented function
     *
     * @param [type] $parameter
     * @return void
     */
    public function parameterChecker(&$parameter){
        if ($parameter instanceof \Illuminate\Support\Collection) {
            $parameter = $parameter->toArray();
        }

        if (!is_array($parameter)) {
            throw new UnprocessableEntityHttpException('Invalid parameter format');
        }
    }
}
