<?php

namespace App\Adapters;
use App\Interfaces\AdapterInterface;

class DataProviderXAdapter implements AdapterInterface
{
    const statusCode =[
        '1'  => 'authorised',
        '2'  => 'decline',
        '3'  => 'refunded'
    ];

    public function get() : array
    {
        $data = json_decode(\File::get(storage_path('DataProvider/DataProviderX.json')));
        return array_map(function($item) {
            return [
                'id'            => $item->parentIdentification,
                'email'         => $item->parentEmail,
                'balance'       => $item->parentAmount,
                'currency'      => $item->Currency,
                'statusCode'    => self::statusCode[$item->statusCode],
                'created_at'    => $item->registerationDate,
                'provider'      => 'DataProviderX'
            ];
        }, $data);
    }
}
