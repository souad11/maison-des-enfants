<?php 

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        // return [
        //     'id' => $this->id,
        //     'price_id' => $this->price_id,
        //     'title' => $this->title,
        //     'description' => $this->description,
        //     'start_date' => $this->start_date,
        //     'end_date' => $this->end_date,
        //     //'price_details' => new PriceResource($this->whenLoaded('price')),  // Assuming you have a PriceResource
        //     //'groups' => GroupResource::collection($this->whenLoaded('groups'))  // Assuming you have a GroupResource
        // ];

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'groups' => $this->groups->map(function ($group) {
                return [
                    'group_id' => $group->id,
                    'group_title' => $group->title,
                    // Ajoutez d'autres attributs du groupe ici si nécessaire
                ];
            }),
        ];
    }
}
