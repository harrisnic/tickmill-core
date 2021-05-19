<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => [
                'id' => $this->id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'avatar' => $this->avatar,
                'transactions' => TransactionResource::collection($this->transactions)
            ]
        ];
    }

    /**
     * @param Request $request
     * @return string[]
     */
    public function with($request): array
    {
        return ['status' => 'success'];
    }
}
