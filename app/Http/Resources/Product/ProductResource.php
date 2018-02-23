<?php
namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'name'          => $this->name,
            'description'   => $this->detail,
            'prices'        => $this->price,
            'stock '        => $this->stock == 0 ? 'Out Of Stock' : $this->stock,
            'discount'      => $this->discount,
            'totalPrice'    => round((1-($this->discount/100)) * $this->price, 2),
            'rating'        => $this->review->count() > 0 ? round($this->review->sum('star')/$this->review->count(),2):'No Rating',
            'href'          => [
                'reviews'   => route('review.index',$this->id)
            ]
        ];
    }
}
