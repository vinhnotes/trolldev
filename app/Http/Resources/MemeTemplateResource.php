<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use URL;

class MemeTemplateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                =>  $this->id,
            'name'              =>  $this->name,
            'description'       =>  $this->description,
            'file'              =>  URL::asset($this->file),
            'filename'          =>  $this->file,
            'slug'              =>  $this->slug,
            'count'             =>  $this->count
        ];
    }
}
