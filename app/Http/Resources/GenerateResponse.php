<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GenerateResponse extends JsonResource
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
                "code" => $this->code,
                "type" => $this->type,
                "batch_id" => $this->export_batch_id,
                "created_at" => $this->created_at,
                "serial_number" => $this->bar_code,
            ];
    }
}
