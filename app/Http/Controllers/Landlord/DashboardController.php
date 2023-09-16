<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\Landlord\Package;
use App\Models\Landlord\Payment;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('package')->get();
        $totalTenantCount = $tenants->count();
        $totalActiveTenantCount = Tenant::totalActiveTenantCount();
        $receivedAmount = Payment::sum('amount');
        $totalPackageCount = Package::count();

        $subscriptionValue = 0;
        foreach ($tenants as $tenant) {
            if($tenant->subscription_type === 'monthly')
                $subscriptionValue += $tenant->package->monthly_fee;
            else if($tenant->subscription_type === 'yearly')
                $subscriptionValue += $tenant->package->yearly_fee;
        }

        return view('landlord.super-admin.pages.dashboard.index',compact('subscriptionValue','receivedAmount','totalTenantCount','totalActiveTenantCount','totalPackageCount'));
    }
}
