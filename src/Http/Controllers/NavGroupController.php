<?php

namespace Layout\Manager\Http\Controllers;

use App\Http\Controllers\Controller;
use Layout\Manager\Http\Requests\NavGroupRequest;
use Layout\Manager\Models\NavGroup;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Layout\Manager\Models\NavItem;
use Pondit\Authorize\Models\Role;
use Illuminate\Http\Request;
use stdClass;
use Exception;
//use another classes

class NavGroupController extends Controller
{

    public static $visiblePermissions = [
        'index' => 'List',
        'create' => 'Create Form',
        'store' => 'Save',
        'show' => 'Details',
        'edit' => 'Edit Form',
        'update' => 'Update',
        'destroy' => 'Delete'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $perPage = $request->input('per_page', 10); // Default 10 items per page

        $navGroups = NavGroup::with('navItems')->latest()->paginate($perPage);

        foreach ($navGroups as $navGroup) {
            $navGroup->total_nav_item = $navGroup->navItems->count();
            $parent = NavGroup::find($navGroup->parent_id);
            $navGroup->parent = $parent->title ?? '';
        }

        return view('layout::nav-groups.index', compact('navGroups'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tree_options = NavGroup::treeOptions();
        return view('layout::nav-groups.create', compact('tree_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NavGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $navGroup = NavGroup::create(['id' => Str::uuid(), 'parent_id' => $request->input('parent_id')] + $request->all());
            //handle relationship store
            return redirect()->route('nav-groups.index')
                ->withSuccess(__('Successfully Created'));
        } catch (\Exception | QueryException $e) {
            \Log::channel('pondit')->error($e->getMessage());
            return redirect()->back()->withInput()->withErrors(
                config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NavGroup  $navGroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $navGroup        = NavGroup::where('id', $id)->first();
        $parent      = $navGroup->parent_id;
        $parent_name = NavGroup::where('id', $parent)->pluck('title')->first();

        return view('layout::nav-groups.show', compact('navGroup', 'parent_name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NavGroup  $navGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $navGroup         = NavGroup::where('id', $id)->first();
        $tree_options = NavGroup::treeOptions($navGroup->parent_id);

        return view('layout::nav-groups.edit', compact('navGroup', 'tree_options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\NavGroupRequest  $request
     * @param  \App\Models\NavGroup  $navGroup
     * @return \Illuminate\Http\Response
     */
    public function update(NavGroupRequest $request, NavGroup $navGroup)
    {

        try {
            $navGroup->update(['parent_id' => $request->input('parent_id')] + $request->all());
            //handle relationship update
            return redirect()->route('nav-groups.index')
                ->withSuccess(__('Successfully Updated'));
        } catch (\Exception | QueryException $e) {
            \Log::channel('pondit')->error($e->getMessage());
            return redirect()->back()->withInput()->withErrors(
                config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NavGroup  $navGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(NavGroup $navGroup)
    {
        try {
            $navGroup->delete();

            return redirect()->route('nav-groups.index')
                ->withSuccess(__('Successfully Deleted'));
        } catch (\Exception | QueryException $e) {
            \Log::channel('pondit')->error($e->getMessage());
            return redirect()->back()->withInput()->withErrors(
                config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
            );
        }
    }

    //another methods

    public function groupItemMap()
    {
        $navGroups = NavGroup::orderBy('title', 'asc')->get();
        return view('layout::nav-groups.group-item-map', compact('navGroups'));
    }

    public function groupItemMapStore(Request $request)
    {

        try {
            $navGroupId = $request->input('navgroup_id');
            $selectedNavItems = $request->input('navItems');

            $navGroup = NavGroup::find($navGroupId);

            $navItems = NavItem::all();

            $navGroup->navItems()->detach();

            if ($selectedNavItems != null) {
                foreach ($selectedNavItems as $navId => $navItem) {
                    if (!$navGroup->navItems->contains($navId)) {
                        $navGroup->navItems()->attach($navId, [
                            'id' => Str::uuid(),  // Generate a new UUID
                            'tenant_id' => auth()->user()->tenant_id ?? null, // Assign tenant_id if needed
                        ]);
                    }
                }
            }
            return redirect()->route('nav-group-item-map')
                ->withSuccess(__('Recored Stored Successfully'));
        } catch (\Exception | QueryException $e) {
            \Log::channel('pondit')->error($e->getMessage());
            return redirect()->back()->withInput()->withErrors(
                config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
            );
        }
    }

    public function navGroupPosition()
    {
        $navGroups = NavGroup::orderBy('position')->get();
        $groupNavs = [];

        $user = auth()->user();
        $userRole = $user->active_role_id ?? null;

        $role = Role::find($userRole)->cacheRoleNav()->first();
        $roleNavs = new stdClass;
        if ($role) {
            $roleNavs = $role->data_navs;
        } else {
            $roleNavs = json_encode(["Start Menu" => ["child" => [], "navItems" => [["url" => "/", "icon" => "icon-copy", "title" => "Home", "position" => 1]], "groupIcon" => ""]]);
        }

        $groupNavs = $roleNavs;


        return view('navigation::nav-groups.nav-group-position', compact('navGroups', 'groupNavs'));
    }
}
