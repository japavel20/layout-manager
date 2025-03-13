<?php

namespace Layout\Manager\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Layout\Manager\Models\NavItem;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intelliapp\Authorize\Models\Role;
//use another classes

class NavItemController extends Controller
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
        $navItems = NavItem::latest()->get();

        return response()->json([
            'status' => true,
            'data' => $navItems
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
            $navItem = NavItem::create(['id' => Str::uuid()] + $request->all());
            //handle relationship store
            return response()->json([
                'status' => true,
                'message' => __('Successfully Created'),
                'data' => $navItem
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
     * @param  \App\Models\NavItem  $navItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(NavItem $navItem)
    {
        return response()->json([
            'status' => true,
            'data' => $navItem
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\NavItem  $navItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, NavItem $navItem)
    {
        try {
            $navItem->update($request->all());
            //handle relationship update
            return response()->json([
                'status' => true,
                'message' => __('Successfully Updated'),
                'data' => $navItem
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
     * @param  \App\Models\NavItem  $navItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(NavItem $navItem)
    {
        try {
            $navItem->delete();

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

    //another methods
    public function getNavitemWithSelected($roleId)
    {
        $role = Role::find($roleId);



        $navitems = NavItem::all()->sortBy('title');

        $collection = [];
        foreach ($navitems as $navitem) {
            if ($role->navitems->contains($navitem->id)) {
                $collection[] = ['id' => $navitem->id, 'title' => $navitem->title, 'isSelected' => 1];
            } else {
                $collection[] = ['id' => $navitem->id, 'title' => $navitem->title, 'isSelected' => 0];
            }
        }
        $navItems = collect($collection)->chunk(count($collection) / 2);
        return response()->json($navItems, 200);
    }
}
