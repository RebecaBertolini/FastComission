<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //especifica o que sera retornado
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'commission' => $this->commission,
            'created_at' => Carbon::make($this->created_at)->format('d-m-Y')
            // 'created_at' => $this->created_at
        ];
    }
}
