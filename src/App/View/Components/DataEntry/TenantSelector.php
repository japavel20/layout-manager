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
    public $isSuperAdmin;

    public function __construct($label = 'Select Tenant', $placeholder = 'Select Tenant')
    {
        $user = Auth::user();

        $this->isSuperAdmin = $user && $user->active_role_id == 1;
        // If the user is a super admin, fetch all tenants
        if ($this->isSuperAdmin) {
            $this->tenants = Tenant::all(); // Get all tenants
        } else {
            // Otherwise, set only the user's tenant ID
            $this->tenantId = $user->tenant_id;
        }
        // Default label and placeholder
        $this->label = $label;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('layout::components.data-entry.tenant-selector');
    }
}
