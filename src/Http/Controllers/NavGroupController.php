<?php

namespace Layout\Manager\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Layout\Manager\Http\Requests\NavGroupRequest;
use Layout\Manager\Models\NavGroup;
use Layout\Manager\Models\NavItem;
use Illuminate\Support\Str;
use Pondit\Authorize\Models\Role;
use stdClass;

class NavGroupController extends NavGroupBaseController
{
    public function groupItemMap()
    {
        $navGroups = NavGroup::orderBy('title', 'asc')->get();
        return view('layout::nav-groups.group-item-map', compact('navGroups'));
    }

    public function index()
    {
        $navGroups = NavGroup::with('navItems')->latest()->get();
        foreach ($navGroups as $navGroup) {

            $navGroup->total_nav_item = count($navGroup->navItems);
            $parent = NavGroup::find($navGroup->parent_id);

            $navGroup->parent = $parent->title ?? '';
        }

        return view('layout::nav-groups.index', [
            'navGroups' => $navGroups
        ]);
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
                        $navGroup->navItems()->attach($navId);
                    }
                }
            }

            return redirect()->route('nav-groups.index')
                ->withSuccess(__('Recored Stored Successfully'));
        } catch (\Exception | QueryException $e) {
            \Log::channel('pondit')->error($e->getMessage());
            return redirect()->back()->withInput()->withErrors(
                config('app.env') == 'production' ? __('Somethings Went Wrong') : $e->getMessage()
            );
        }


        // dd($navGroup->navItems()->where('nav_item_id', $navItem->id)->exists());
        // if (!$navGroup->navItems->contains($navItem->id)) {
        //     $navGroup->navItems()->attach($navItem);
        // }
    }

    public function create()
    {
        $tree_options = NavGroup::treeOptions();
        return view('layout::nav-groups.create', compact('tree_options'));
    }
    public function store(Request $request)
    {

        try {
            $navGroup = NavGroup::create(['uuid' => Str::uuid(), 'parent_id' => $request->input('parent_id')] + $request->all());
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
    public function show($uuid)
    {

        $navGroup        = NavGroup::where('uuid', $uuid)->first();

        $parent      = $navGroup->parent_id;
        $parent_name = NavGroup::where('id', $parent)->pluck('title')->first();

        return view('navigation::nav-groups.show', compact('navGroup', 'parent_name'));
    }
    public function edit($uuid)
    {
        $navGroup         = NavGroup::where('uuid', $uuid)->first();
        $tree_options = NavGroup::treeOptions($navGroup->parent_id);

        return view('navigation::nav-groups.edit', compact('navGroup', 'tree_options'));
    }
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
