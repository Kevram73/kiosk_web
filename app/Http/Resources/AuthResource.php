<?php

namespace App\Http\Resources;

use FontLib\Table\Type\name;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */


    public function toArray($request)
    {

        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'boutique_id'=>$this->boutique_id,
            'token'=>$this->api_token,
        ];
    }

}
