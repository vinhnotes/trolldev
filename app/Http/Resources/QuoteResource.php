<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                =>  $this->id,
            'content'           =>  $this->content,
            'author'            =>  $this->author,
        ];
    }
}
