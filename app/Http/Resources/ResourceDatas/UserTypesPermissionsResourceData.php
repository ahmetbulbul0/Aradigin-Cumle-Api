<?php

namespace App\Http\Resources\ResourceDatas;

class UserTypesPermissionsResourceData
{
    static function get($thisData)
    {
        $data = [
            "no" => $thisData->no,
        ];

        return $data;
    }
}
