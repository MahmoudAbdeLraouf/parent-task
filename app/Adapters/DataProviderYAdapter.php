<?php

namespace App\Adapters;
use App\Interfaces\AdapterInterface;

class DataProviderYAdapter implements AdapterInterface
{
    const statusCode =[
        '100'  => 'authorised',
        '200'  => 'decline',
        '300'  => 'refunded'
    ];
    public function get() : array
    {
        $data = json_decode(\File::get(storage_path('DataProvider/DataProviderY.json')));
        return array_map(function($item) {
            return [
                'id'            => $item->id,
                'email'         => $item->email,
                'balance'       => $item->balance,
                'currency'      => $item->currency,
                'statusCode'    => self::statusCode[$item->status],
                'created_at'    => $item->created_at,
                'provider'      => 'DataProviderY'
            ];
        }, $data);
    }
}
