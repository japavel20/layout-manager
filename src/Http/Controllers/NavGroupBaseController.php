<?php

namespace Layout\Manager\Http\Controllers;

use App\Http\Controllers\Controller;
use Layout\Manager\Http\Requests\NavGroupRequest;
use Layout\Manager\Models\NavGroup;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
//use another classes

class NavGroupBaseController extends Controller
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
    // public function index()
    // {
    //     return view('layout::nav-groups.index', [
    //         'navGroups' => NavGroup::latest()->get()
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layout::nav-groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NavGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NavGroupRequest $request)
    {
        try {
            $navGroup = NavGroup::create(['uuid' => Str::uuid()] + $request->all());
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
    public function show(NavGroup $navGroup)
    {
        return view('navigation::nav-groups.show', compact('navGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NavGroup  $navGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(NavGroup $navGroup)
    {
        return view('navigation::nav-groups.edit', compact('navGroup'));
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
            $navGroup->update($request->all());
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
}
