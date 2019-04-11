<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($data) {
                                return [
                                    'name'        => $data->name,
                                    'totalPrice'  => round((1 - ($data->discount/100)) * $data->price, 2),
                                    'rating'      => $data->reviews->count() > 0 ? round($data->reviews->sum('star') / $data->reviews->count(), 2) : 'Not Rating Yet',
                                    'discount'    => $data->discount,
                                    'href'        => [
                                        'reviews' => route('products.show', $data->id)
                                    ],
                                ];
                            }),
        ];
    }
}
