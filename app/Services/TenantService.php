<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class TenantService
{
    public function permissionUpdate($tenant, $request, $package)
    {
        $prevPermissions = json_decode($tenant->package->permissions, true);
        $prevPermissionIds = array_column($prevPermissions, 'id');

        $tenant->package_id = $request->package_id;
        $tenant->update();

        $latestPermissions = json_decode($package->permissions, true);
        $latestPermissionsIds = array_column($latestPermissions, 'id');

        $newAddedPermissions = [];
        foreach ($latestPermissions as $element) {
            if (!in_array($element["id"], $prevPermissionIds)) {
                $newAddedPermissions[] = $element;
            }
        }

        $tenant->run(function () use ($newAddedPermissions, $latestPermissionsIds) {
            DB::table('permissions')->whereNotIn('id', $latestPermissionsIds)->delete();
            DB::table('permissions')->insert($newAddedPermissions);
            $role = Role::findById(1);
            $role->syncPermissions($latestPermissionsIds);
        });
    }
}
