<?php

namespace App\Http\Resources;

use App\Http\Resources\ResourceDatas\UserTypesResourceData;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserTypePermissionsResource;

class UserTypePermissionsUserTypesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = UserTypesResourceData::get($this);

        return $data;
    }
}
