<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'contact_no' => $this->contact_no,
            'is_admin' => $this->is_admin,
            'created_at' => !empty($this->created_at)
            ? $this->created_at->diffForHumans()
            : null,
        ];
    }
}
