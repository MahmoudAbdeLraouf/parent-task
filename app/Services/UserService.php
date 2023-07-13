<?php

namespace App\Services;

use App\Interfaces\AdapterInterface;
use App\Interfaces\StockCheckerInterface;
use App\Interfaces\UserInterface;

class UserService implements UserInterface
{
    private $dataProviderAdapter;
    public function __construct(AdapterInterface $dataProviderAdapter)
    {
        $this->dataProviderAdapter = $dataProviderAdapter;
    }

    public function list($request) : object
    {
        $data = collect($this->dataProviderAdapter->get());

        //provider filter
        if($request->has('provider')) {
            $data = $this->filterUser($data, $request, 'provider', $request->provider);
        }

        //status filter
        if($request->has('statusCode')) {
            $data = $this->filterUser($data, $request, 'statusCode', $request->statusCode);
        }

        //balance filter
        if($request->has('balanceMin') && $request->has('balanceMax')) {
            $data = $this->filterUser($data, $request, 'balance', [$request->balanceMin, $request->balanceMax]);
        }

        //provider filter
        if($request->has('currency')) {
            $data = $this->filterUser($data, $request, 'currency', $request->currency);
        }
        return $data;
    }

    private function filterUser($data, $request, $key, $filter) : object {
        return $data->filter(function ($item) use ($request, $key, $filter) {
            return is_array($filter) ? $item[$key] >= (int)$filter[0] && $item[$key] <= (int)$filter[1] :$item[$key] == $filter;
        });
    }
}
