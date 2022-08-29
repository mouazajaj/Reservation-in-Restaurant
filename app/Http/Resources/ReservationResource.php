<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'attributes' => [
                'first_name' => $this->first_name,
                'last_name'=>$this->last_name,
                'tel_number'=>$this->tel_number,

                'email' => $this->email,
                'table_id'=>$this->table_id,
                'res_date'=>$this->res_date,
                'guest_number'=>$this->guest_number,
                
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ]
        ];
    }
}
