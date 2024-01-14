<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Http\traits\AutoUpdateTrait;
use App\Http\traits\ENVFilePutContent;
use App\Models\Landlord\Package;
use App\Models\Landlord\Payment;
use App\Models\Tenant;
class DashboardController extends Controller
{
    use AutoUpdateTrait, ENVFilePutContent;

    public function index()
    {
        // $autoUpdateData = $this->general();
        $alertVersionUpgradeEnable = null; //$autoUpdateData['alertVersionUpgradeEnable'];
        $alertBugEnable =  null; //$autoUpdateData['alertBugEnable'];


        $tenants = Tenant::with('package')->get();
        $totalTenantCount = $tenants->count();
        $totalActiveTenantCount = Tenant::totalActiveTenantCount();
        $receivedAmount = Payment::sum('amount');
        $totalPackageCount = Package::count();

        $subscriptionValue = 0;
        foreach ($tenants as $tenant) {
            if($tenant->subscription_type === 'monthly')
                $subscriptionValue += isset($tenant->package->monthly_fee) ? $tenant->package->monthly_fee : 0;
            else if($tenant->subscription_type === 'yearly')
                $subscriptionValue += isset($tenant->package->yearly_fee) ? $tenant->package->yearly_fee : 0;
        }

        return view('landlord.super-admin.pages.dashboard.index',compact('subscriptionValue','receivedAmount',
            'totalTenantCount','totalActiveTenantCount','totalPackageCount','alertBugEnable','alertVersionUpgradeEnable'
        ));
    }
}
