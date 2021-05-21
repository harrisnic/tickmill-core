<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => [
                'id' => $this->id,
                'client_name' => $this->client->first_name . ' ' . $this->client->last_name,
                'amount' => $this->amount,
                'created_at' => $this->created_at->format('d/m/Y H:i:s'),
                'updated_at' => $this->updated_at->format('d/m/Y H:i:s'),
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
