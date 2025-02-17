<?php

namespace Layout\Manager\Http\Controllers;

use App\Http\Controllers\Controller;
use Layout\Manager\Http\Requests\NavItemRequest;
use Layout\Manager\Models\NavItem;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
//use another classes

class NavItemController extends Controller
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
    public function index()
    {
        return view('layout::nav-items.index', [
            'navItems' => NavItem::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layout::nav-items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NavItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NavItemRequest $request)
    {
        try {
            $navItem = NavItem::create(['uuid' => Str::uuid()] + $request->all());
            //handle relationship store
            return redirect()->route('nav-items.index')
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
     * @param  \App\Models\NavItem  $navItem
     * @return \Illuminate\Http\Response
     */
    public function show(NavItem $navItem)
    {
        return view('navigation::nav-items.show', compact('navItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NavItem  $navItem
     * @return \Illuminate\Http\Response
     */
    public function edit(NavItem $navItem)
    {
        return view('navigation::nav-items.edit', compact('navItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\NavItemRequest  $request
     * @param  \App\Models\NavItem  $navItem
     * @return \Illuminate\Http\Response
     */
    public function update(NavItemRequest $request, NavItem $navItem)
    {
        try {
            $navItem->update($request->all());
            //handle relationship update
            return redirect()->route('nav-items.index')
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
     * @param  \App\Models\NavItem  $navItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(NavItem $navItem)
    {
        try {
            $navItem->delete();

            return redirect()->route('nav-items.index')
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
