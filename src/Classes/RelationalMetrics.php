<?php

namespace Zainaldeen\RelationalMetrics\Classes;

use Zainaldeen\RelationalMetrics\Abstracts\RelationalRelationAbstract;
use Zainaldeen\RelationalMetrics\Interfaces\RelationalInterface;

/**
 * Class ClassToBuild
 *
 * @author your name
 * @package SOS\MultiProcess\Classes
 */
class RelationalMetrics extends RelationalRelationAbstract implements RelationalInterface
{
    public function __construct(string $target)
    {
        if (class_exists($target)) {
            $this->model = app("App\\Models" . $target);
        } else {
            return "Target Model ". $target. " Is Not Found!";
        }
    }

    public function getBasicMetrics()
    {
        $model_count = $this->getCountDirectly();

        return $this->returnFinalResponse($model_count);
    }

    public function getRelationalMetrics($relation, $column, $value)
    {
        $model_count = $this->returnRelationalCount($relation, $column, $value);

        return $this->returnFinalResponse($model_count);
    }

    public function getConditionalMetrics($conditions)
    {
        $model_count = $this->getCountWithConditions($conditions);

        return $this->returnFinalResponse($model_count);
    }
}
