<?php

namespace Layout\Manager\Http\Controllers;

use App\Http\Controllers\Controller;
use Layout\Manager\Http\Requests\TenantRequest;
use Layout\Manager\Models\Tenant;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

//use another classes

class TenantController extends Controller
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
        $perPage = $request->input('per_page', 10); // Default to 10 if not specified
        $tenants = Tenant::latest()->paginate($perPage);

        return view('layout::tenants.index', compact('tenants'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layout::tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TenantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TenantRequest $request)
    {
        try {
            $tenant = Tenant::create(['id' => Str::uuid()] + $request->all());
            //handle relationship store
            return redirect()->route('tenants.index')
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
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        return view('layout::tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant)
    {
        return view('layout::tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TenantRequest  $request
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(TenantRequest $request, Tenant $tenant)
    {
        try {
            $tenant->update($request->all());
            //handle relationship update
            return redirect()->route('tenants.index')
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
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        try {
            $tenant->delete();

            return redirect()->route('tenants.index')
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
