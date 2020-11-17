<?php

namespace App\Http\Controllers\Api\Companies;

use App\Events\UserAttached;
use App\Http\Controllers\Controller;
use App\Http\Resources\Companies\CompanyClientCollection;
use App\Http\Resources\Companies\CompanyCollection;
use App\Models\Companies\Company;
use App\Http\Requests\Companies\CompanyRequest as Request;
use App\Models\Users\User;
use Illuminate\Support\Facades\Gate;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        $response = Gate::inspect('viewAny', auth()->user());
        if (!$response->allowed()){
            return response(auth()->user()->company()->exists()
                ? $this->companyCollection($company)
                : 'There is no company',
            201);
        }
        try {
            return new CompanyCollection($company->paginate(5));
        } catch (\Exception $e){
            return response([ 'message' => $e->getMessage() ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
        $response = Gate::inspect('create', auth()->user());
        if (!$response->allowed()){
            return response([ 'message' => $response->message() ], 403);
        }
        try {
            return response([
                    'message' => 'Company created successfully',
                    'data' => collect($company->create($request->all()))->except(['created_at','updated_at'], 201)
                ],
                201);

        } catch (\Exception $e){
            return response([ 'message' => $e->getMessage() ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $response = Gate::inspect('update', auth()->user());
        if (!$response->allowed())
            return response([ 'message' => $response->message() ], 403);

        try {
            return response([
                'message' => 'Company updated successfully',
                'data' => $company->update($request->all())
            ], 201);
        } catch (\Exception $e){
            return response([ 'message' => $e->getMessage() ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }

    public function attach(Company $company){
        $response = Gate::inspect('update', auth()->user());
        if (!$response->allowed()){
            return response([ 'message' => $response->message() ], 403);
        }
        collect(request('userIds'))->map(function ($userId) use($company){
            $user =User::find($userId);
            if (isset($user) && is_null($user->company_id) ){
                $user->update(['joined_at' => now(), 'company_id' ]);
                // Fire Email Event
                event( new UserAttached($user));
            }
        });
        return response(['data' => 'Done'], 201);
    }

    public function clients(Company $company){
        $response = Gate::inspect('viewAny', auth()->user());
        if (!$response->allowed())
            return response([ 'message' => $response->message() ], 403);
        if ($company->users()->exists())
            return response((new CompanyClientCollection($company->users()->paginate(1)))->response()->getData(true), 201);
        else
            return response(['data' => 'There is no client'], 201);
    }

    private function companyCollection($company)
    {
        return collect([
            'id' => $company->id,
            'name' => $company->name,
            'prettyAddress' => $company->prettyAddress(),
            'address' => [
                'street' => $company->street_address,
                'houseNo' => $company->house_no,
                'city' => $company->city,
                'country' => $company->country,
            ],
            'phone_no' => $company->phone_no,
            'vat_no' => $company->vat_no,
            'status' => $company->status,
            'createdAt' => $company->created_at,
            'updatedAt' => $company->updated_at
        ]);
    }


}
