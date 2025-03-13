<?php

namespace Layout\Manager\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Layout\Manager\Models\NavItem;
use Layout\Manager\Models\NavGroup;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
//use another classes

class NavGroupController extends Controller
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
        $navGroups = NavGroup::with('navItems')->latest()->get();

        return response()->json([
            'status' => true,
            'data' => $navGroups
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
            $navGroup = NavGroup::create(['id' => Str::uuid()] + $request->all());
            //handle relationship store
            return response()->json([
                'status' => true,
                'message' => __('Successfully Created'),
                'data' => $navGroup
            ], 201);
        } catch (\Exception | QueryException $e) {
            \Log::channel('pondit')->error($e->getMessage());
            return response()->json([
                'error' => config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NavGroup  $navGroup
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(NavGroup $navGroup)
    {
        return response()->json([
            'status' => true,
            'data' => $navGroup
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\NavGroup  $navGroup
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, NavGroup $navGroup)
    {
        try {
            $navGroup->update($request->all());
            //handle relationship update
            return response()->json([
                'status' => true,
                'message' => __('Successfully Updated'),
                'data' => $navGroup
            ], 200);
        } catch (\Exception | QueryException $e) {
            \Log::channel('pondit')->error($e->getMessage());
            return response()->json([
                'error' => config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NavGroup  $navGroup
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(NavGroup $navGroup)
    {
        try {
            $navGroup->delete();

            return response()->json([
                'status' => true,
                'message' => __('Successfully Deleted')
            ], 200);
        } catch (\Exception | QueryException $e) {
            \Log::channel('pondit')->error($e->getMessage());
            return response()->json([
                'error' => config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
            ], 500);
        }
    }

    public function getNavItemWithSelected($locationId)
    {
        $navGroup = NavGroup::find($locationId);

        $navItems = NavItem::all();

        $collection = [];
        foreach ($navItems as $navItem) {
            if ($navGroup->navItems->contains($navItem->id)) {
                $collection[] = ['id' => $navItem->id, 'title' => $navItem->title, 'isSelected' => 1];
            } else {
                $collection[] = ['id' => $navItem->id, 'title' => $navItem->title, 'isSelected' => 0];
            }
        }

        return response()->json($collection, 200);
    }

    //another methods
}
