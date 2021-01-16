<?php
namespace App\Utilities\ModelHelper;

use Exception;
use App\Utilities\ModelHelper\Abstract\ModelHelperAbstract;

class ModelHelperManager 
{

    /**
     * @var App\Utilities\ModelHelper\Contracts\ModelHelperInterface
     */
    private $helper;

    /**
     * @param string $model
     * @return this
     */
    public function init(string $helper) {
        $this->helper = new $helper;   

        if ($this->helper instanceof ModelHelperAbstract)  {
            return $this;
        }

        throw new Exception("Invalid Model Helper");
    }

    /**
     * __call function
     * 
     * it a magic method use to dynamically set a method.
     *
     * @param [type] $name
     * @param [type] $arguments
     * @return mix
     */
    public function __call($name, $arguments)
    {
        return $this->helper->{$name}($arguments[0]); // since the available method as of now is prepareParameter lets assume that one arguments passed.
    }
}