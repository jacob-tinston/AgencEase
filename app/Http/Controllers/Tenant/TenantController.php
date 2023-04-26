<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Central\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'organization' => 'string|max:255',
        ]);

        $tenant = Tenant::find(tenant('id'));

        $tenant->update([
            'organization' => $data['organization'],
        ]);

        return back()->with('success', 'Organization Updated Successfully.');
    }

    public function updateCustomizer(Request $request)
    {
        $tenant = Tenant::find(tenant('id'));

        $tenant->update([
            'customizer' => json_encode($request->all()),
        ]);
    }
}
