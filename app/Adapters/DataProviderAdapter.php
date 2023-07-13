<?php

namespace App\Adapters;
use App\Interfaces\AdapterInterface;
use App\Adapters\DataProviderYAdapter;
use App\Adapters\DataProviderXAdapter;

class DataProviderAdapter implements AdapterInterface
{
    private $dataProviders = [];

    public function __construct(DataProviderXAdapter $dataProviderXAdapter, DataProviderYAdapter $dataProviderYAdapter)
    {
        $this->dataProviders[0] = $dataProviderXAdapter;
        $this->dataProviders[1] = $dataProviderYAdapter;
    }

    public function get() :array
    {
        $data = array();
        foreach ($this->dataProviders as $dataProvider) {
            $data = array_merge($data, $dataProvider->get());
        }
        return $data;
    }
}
