<?php

namespace Zainaldeen\RelationalMetrics\Interfaces;

interface RelationalInterface
{
    public function getBasicMetrics();

    public function getRelationalMetrics($relation, $column, $value);

    public function getConditionalMetrics($conditions);
}
