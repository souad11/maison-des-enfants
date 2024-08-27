<?php 

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'website' => $this->website,
            'picture' => $this->picture,
            
        ];
    }
}
