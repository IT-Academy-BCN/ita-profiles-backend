<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecruiterListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user->id,
            'id' => $this->id,
            'name' => ucwords($this->user->name),
            'surname' => ucwords($this->user->surname),
            'company' => ucwords($this->company),
            'sector' => $this->sector,
        ];
    }
}
