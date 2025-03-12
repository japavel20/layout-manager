@props([
    'label' => 'Select Tenant',
    'placeholder' => 'Select Tenant',
])
@if(auth()->user()->active_role_id == 1)
    <div class="form-group mb-4">
        <label class="label text-secondary">{{ $label }}</label>
        <select class="form-select form-control h-55" aria-label="Default select example" name="tenant_id" id="tenant_id">
            <option value="" selected>{{ $placeholder }}</option>
            @foreach($tenants as $tenant)
                <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
            @endforeach
        </select>
    </div>
@else
    <input type="hidden" name="tenant_id" value="{{ $tenantId }}">
@endif