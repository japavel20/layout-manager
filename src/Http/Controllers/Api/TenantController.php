<?php

namespace Layout\Manager\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Layout\Manager\Models\Tenant;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
//use another classes

class TenantController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Response status code
    |--------------------------------------------------------------------------
    | 201 response with created data
    | 200 update/list/show/delete
    | 204 deleted response with no content
    | 500 internal server or db error
    */

    public static $visiblePermissions = [
        'index' => 'List',
        'create' => 'Create Form',
        'store' => 'Save',
        'show' => 'Details',
        'update' => 'Update',
        'destroy' => 'Delete'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tenants = Tenant::latest()->get();

        return response()->json([
            'status' => true,
            'data' => $tenants
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $tenant = Tenant::create(['id' => Str::uuid()] + $request->all());
            //handle relationship store
            return response()->json([
                'status' => true,
                'message' => __('Successfully Created'),
                'data' => $tenant
            ], 201);
        } catch (\Exception | QueryException $e) {
            \Log::channel('intelliapp')->error($e->getMessage());
            return response()->json([
                'error' => config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Tenant $tenant)
    {
        return response()->json([
            'status' => true,
            'data' => $tenant
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Tenant $tenant)
    {
        try {
            $tenant->update($request->all());
            //handle relationship update
            return response()->json([
                'status' => true,
                'message' => __('Successfully Updated'),
                'data' => $tenant
            ], 200);
        } catch (\Exception | QueryException $e) {
            \Log::channel('intelliapp')->error($e->getMessage());
            return response()->json([
                'error' => config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Tenant $tenant)
    {
        try {
            $tenant->delete();

            return response()->json([
                'status' => true,
                'message' => __('Successfully Deleted')
            ], 200);
        } catch (\Exception | QueryException $e) {
            \Log::channel('intelliapp')->error($e->getMessage());
            return response()->json([
                'error' => config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

    //another methods
}
