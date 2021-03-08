<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $createdDate = new DateTime($this->created_at);
        $createdFormated = $createdDate->format('d-m-Y H:i:s');
        
        return [
            'id'         => $this->id,
            'from'       => new UserRessource($this->fromUser),
            'to'         => new UserRessource($this->toUser),
            'created_at' => $createdFormated
        ];
    }
}
