<?php

namespace App\Http\Resources\Companies;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CompanyClientCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $collection =  $this->collection->map(function ($client) {
            return collect([
                'id' => $client->id,
                'firstName' => $client->first_name,
                'lastName' => $client->last_name,
                'fullName' => $client->fullName(),
                'userName' => $client->email,
                'lastLoggedIn' => $client->last_login,
                'userSince' => $client->joined_at,
            ]);
        });

        return [
            'data' => $collection,
            'links' => [
                'self' => 'link-value'
            ],
        ];


    }
}
