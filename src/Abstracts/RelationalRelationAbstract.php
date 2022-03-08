<?php

namespace Zainaldeen\RelationalMetrics\Abstracts;

abstract class RelationalRelationAbstract
{
    protected $model = '';

    protected function returnRelationalCount($relation, $column, $value)
    {
        $model_value = $this->model::query()
            ->whereHas($relation, function ($q) use ($column, $value) {
                return $q->latest()->where($column, $value);
            })->get();

        return $model_value->count();
    }

    protected function getCountWithConditions($conditions): int
    {
        $model_value = $this->model::query();
        foreach ($conditions as $condition) {
            $model_value = $model_value
                ->{$condition["method"]}(
                    ($condition["column"]),
                    $condition['operator'] ?? '',
                    $condition["value"] ?? ''
                );
        }
        $model_value = $this->model::get();

        return count($model_value);
    }

    protected function getCountDirectly()
    {
        return $this->model::query()->get()->count();
    }

    protected function returnFinalResponse($model_count): array
    {
        return  [
            'name' => $this->getResponseName(),
            'count' => $model_count,
        ];
    }

    protected function getResponseName()
    {
        $path = explode('\\', $this->model);

        return 'Total '.$path[count($path) - 1].' Number';
    }
}
