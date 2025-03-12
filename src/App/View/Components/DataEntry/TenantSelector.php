<?php

namespace Layout\Manager\App\View\Components\DataEntry;

use Illuminate\View\Component;
use Layout\Manager\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class TenantSelector extends Component
{
    public $tenants;
    public $tenantId;
    public $label;
    public $placeholder;

    public function __construct($label = 'Select Tenant', $placeholder = 'Select Tenant')
    {
        $user = Auth::user();

        // If the user is a super admin, load all tenants
        if ($user && $user->active_role_id == 1) {
            $this->tenants = Tenant::all();
        } else {
            // Otherwise, set only their tenant ID
            $this->tenantId = $user?->tenant_id;
        }
        // Default selected value
        $this->label = $label;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('layout::components.data-entry.tenant-selector');
    }
}
