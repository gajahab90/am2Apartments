<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     * @throws \Exception
     */
    public function toArray($request)
    {
        $requestedCurrency = isset($request->currency) ? $request->currency : env('DEFAULT_CURRENCY', 'EUR');

        return empty($this->resource) ? null : [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->mergeWhen($request->has('price'), [
                'price' => convert_currency($this->price, $this->currency, $requestedCurrency),
                'currency' => strtoupper($requestedCurrency),
            ]),
            'description' => $this->description,
            'properties' => $this->properties,
            'rating' => $this->when($request->has('rating'), $this->rating),
            'created_at' => $this->when($request->has('created_at'), (string) $this->created_at)
        ];
    }
}
