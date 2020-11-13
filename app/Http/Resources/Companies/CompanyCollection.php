<?php

namespace App\Http\Resources\Companies;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CompanyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $collection = $this->collection->map(function ($company){
            return collect([
                'id' => $company->id,
                'name' => $company->name,
                'prettyAddress' => $company->prettyAddress(),
                'address' => [
                    'street' => $company->street_address,
                    'houseNo' => $company->house,
                    'city' => $company->city,
                    'country' => $company->country,
                ],
                'phone_no' => $company->phone_no,
                'vat_no' => $company->vat_no,
                'status' => $company->status,
                'createdAt' => $company->created_at,
                'updatedAt' => $company->updated_at
            ]);
        });
        return [
            'data' => $collection,
            'links' => [
                'self' => 'link-value',
            ],
        ];

    }
}
