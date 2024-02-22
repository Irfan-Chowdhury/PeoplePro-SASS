<?php

namespace App\Http\Controllers\Landlord;

use App\Contracts\PackageContract;
use App\Contracts\PageContract;
use App\Contracts\SocialContract;
use App\Events\CustomerRegistered;
use App\Events\PackageChanged;
use App\Facades\Alert;
use App\Http\traits\TenantTrait;
use App\Models\Landlord\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\CustomerSignUpRequest;
use App\Http\Requests\Tenant\CustomerUpdateRequest;
use App\Http\Requests\Tenant\RenewExpiryDataRequest;
use App\Http\Requests\Tenant\RenewSubscriptionRequest;
use App\Http\traits\PaymentTrait;
use App\Http\traits\PermissionHandleTrait;
use App\Mail\ConfirmationEmail;
use App\Models\Landlord\Customer;
use App\Models\Landlord\GeneralSetting;
use App\Models\Tenant;
use App\Models\User;
use App\Services\TenantService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class TenantController extends Controller
{
    use TenantTrait;

    public $languageId;
    use PermissionHandleTrait;
    use PaymentTrait;

    public function __construct(
        public SocialContract $socialContract,
        public PageContract $pageContract,
        public PackageContract $packageContract,
        public TenantService $tenantService
    )
    {
        $this->middleware(function ($request, $next){
            $this->languageId = Session::has('TempPublicLangId')==true ? Session::get('TempPublicLangId') : Session::get('DefaultSuperAdminLangId');
            return $next($request);
        });
    }

    public function index()
    {
        $packages = $this->packageContract->getSelectData(['id','name']);

        return view('landlord.super-admin.pages.customers.index', compact('packages'));
    }

    public function datatable()
    {
        $tenants = Tenant::with(['customer','package','domainInfo'])->get();

        if (request()->ajax()) {
            return datatables()->of($tenants)
                ->setRowId(function ($row) {
                    return $row->id;
                })
                ->addColumn('tenantId', function ($row) {
                    return $row->id;
                })
                ->addColumn('database', function ($row) {
                    return $row->tenancy_db_name;
                })
                ->addColumn('domain', function ($row) {
                    return '<a href="https://'.$row->domainInfo->domain.'" target="_blank">'.$row->domainInfo->domain.'</a>';
                })
                ->addColumn('customer', function ($row) {
                    return $row->customer->getFullNameAttribute();
                })
                ->addColumn('email', function ($row) {
                    return $row->customer->email;
                })
                ->addColumn('package', function ($row) {
                    return isset($row->package->name) ? $row->package->name : null;
                })
                ->addColumn('subscription_type', function ($row) {
                    return $row->subscription_type;
                })
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" data-id="'.$row->id.'" class="mr-2 edit btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';
                    $button .= '<button type="button" data-id="'.$row->id.'" class="mr-2 renewSubscription btn btn-warning btn-sm mr-2" title="Renew Subscription"><i class="dripicons-clockwise"></i></button>';
                    $button .= '<button type="button" data-id="'.$row->id.'" class="mr-2 changePackage btn btn-success btn-sm mr-2" title="Change Package"><i class="dripicons-swap"></i></button>';
                    $button .= '<button type="button" data-id="'.$row->id.'" class="mr-2 delete btn btn-danger btn-sm" title="Delete"><i class="dripicons-trash"></i></button>';

                    return $button;
                })
                ->rawColumns(['domain','action'])
                ->make(true);
        }
    }

    public function customerSignUp(CustomerSignUpRequest $request)
    {
        DB::beginTransaction();
        $request->session()->put('price', $request->price);
        try {
            $paymentMethodList = array_column($this->paymentMethods(), 'payment_method');
            if(!$request->is_free_trail && in_array($request->payment_method ,$paymentMethodList)) {
                return redirect(route("payment.pay.page",$request->payment_method), 307);
            }

            $this->tenantService->newTenantGenerate($request);

            event(new CustomerRegistered($request));

            DB::commit();

            $result =  Alert::successMessage('Data Created Successfully');
            if (request()->ajax()) {
                return response()->json($result['alertMsg'], $result['statusCode']);
            } else {
                return redirect()->back()->with(['success' => 'Data Created Successfully']);
            }

        }
        catch (Exception $e) {
            DB::rollback();
            $result =  Alert::errorMessage($e->getMessage());
            return $e->getMessage();

            if (request()->ajax()) {
                return response()->json($result['alertMsg'], $result['statusCode']);
            } else {
                return redirect()->back()->withErrors(['errors' => [$result['alertMsg']]]);
            }
        }
    }


    public function tenantInfo(Tenant $tenant)
    {
        $tenant->load('customer:id,first_name,last_name,email,username,company_name,contact_no');
        return response()->json($tenant);
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $this->tenantService->updateCustomerData($request, $customer);

        $result =  Alert::successMessage('Data Updated Successfully');

        return response()->json($result['alertMsg'], $result['statusCode']);
    }

    public function renewExpiryUpdate(RenewExpiryDataRequest $request, Tenant $tenant)
    {
        DB::beginTransaction();
        try {
            $expiryDate = date('Y-m-d', strtotime($request->expiry_date));

            $generalSetting = GeneralSetting::latest()->first();

            $packageDetailsForTenant = $this->packageDetailsForTenant($tenant->package, $generalSetting, $request);
            $packageDetailsForTenant['expiry_date'] = $expiryDate;

            $tenant->run(function ($tenant) use ($packageDetailsForTenant) {
                $this->setDataInTenantGeneralSetting($packageDetailsForTenant);
            });

            $tenant->expiry_date = $expiryDate;
            $tenant->subscription_type = $request->subscription_type;
            $tenant->update();
            $result =  Alert::successMessage('Data Update Successfully');

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            $result =  Alert::errorMessage($e->getMessage());
        }

        return response()->json($result['alertMsg'], $result['statusCode']);
    }

    public function changePackageProcess(Request $request, Tenant $tenant)
    {
        $package = Package::find($request->package_id);
        $previousPackageName = $tenant->package->name;
        $newPackageName = $package->name;

        DB::beginTransaction();
        try {
            $this->tenantService->packageSwitch($tenant, $request, $package);

            event(new PackageChanged($tenant, $previousPackageName, $newPackageName));

            $result =  Alert::successMessage("Package Switched into the $package->name Successfully");
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            $result =  Alert::errorMessage($e->getMessage());
        }

        return response()->json($result['alertMsg'], $result['statusCode']);
    }

    protected function tenantGenerate($request) : void
    {
        $customer = Customer::create($this->customerData($request));
        $package = Package::find($request->package_id);

        if($package->is_free_trial) {
            $this->createTenant($request, $customer, $package);
            // return \Redirect::to('https://'.$request->tenant.'.'.env('CENTRAL_DOMAIN'));
        }

        // Mail::to($request->email)->send(new ConfirmationEmail($request));
        // event(new CustomerRegistered($request)); // Testing Purpose
    }


    protected function customerData($request)
    {
        return  [
            'company_name' => $request->company_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_no' => $request->contact_no,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ];
    }

    public function destroy(Tenant $tenant)
    {
        try {
            $tenant->domainInfo->delete();
            $tenant->customer->delete();
            self::tenantDirectoryDelete($tenant->id);
            $tenant->delete();
            $result =  Alert::successMessage('Data Created Successfully');
        }
        catch (Exception $e) {
            $result =  Alert::errorMessage($e->getMessage());
        }
        return response()->json($result['alertMsg'], $result['statusCode']);
    }


    protected function tenantDirectoryDelete($tenantId) : void
    {
        $path = public_path('tenants/'.$tenantId);
        if (File::isDirectory($path)) {
            File::deleteDirectory($path);
        }
    }


    public function contactForRenewal(PackageContract $packageContract)
    {
        $socials = $this->socialContract->getOrderByPosition(); //Common
        $pages =  $this->pageContract->getAllByLanguageId($this->languageId); //Common
        $packages = $packageContract->getSelectData(['id','name']);
        $paymentMethods = $this->paymentMethods();

        return view('landlord.public-section.pages.renew.contact_for_renewal', compact('socials','pages','packages','paymentMethods'));
    }


    public function renewSubscription(RenewSubscriptionRequest $request)
    {
        DB::beginTransaction();
        try {
            $package = Package::find($request->package_id);

            if($request->subscription_type == 'monthly')
                $request->session()->put('price', $package->monthly_fee);
            else
                $request->session()->put('price', $package->yearly_fee);


            $paymentMethodList = array_column($this->paymentMethods(), 'payment_method');
            if(!$request->is_free_trail && in_array($request->payment_method ,$paymentMethodList)) {
                return redirect(route("payment.pay.page",$request->payment_method), 307);
            }

            // if ($request->payment_method === 'stripe' || $request->payment_method === 'paypal')
            //     return redirect(route("payment.pay.page",$request->payment_method), 307);

            $tenant = Tenant::find($request->tenant_id);
            $this->tenantService->renewProcess($tenant, $request, $package);

            DB::commit();
            return redirect()->back()->with(['success' => 'Data Created Successfully']);
        }
        catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->withErrors(['errors' => [$e->getMessage()]]);
        }
    }

    // Switch Basic(14) to Standard(2)

    // protected function permissionUpdate($tenant, $request, $package)
    // {
    //     $prevPermissions = json_decode($tenant->package->permissions, true); //P-46 not exist | count-60
    //     $prevPermissionIds = array_column($prevPermissions, 'id');

    //     $latestPermissions = json_decode($package->permissions, true); //P-46 exists | count-96 | Standard(2)
    //     $latestPermissionsIds = array_column($latestPermissions, 'id');

    //     $newAddedPermissions = [];
    //     foreach ($latestPermissions as $element) {
    //         if (!in_array($element["id"], $prevPermissionIds)) {
    //             $newAddedPermissions[] = $element; //P-46 exists | count-42
    //         }
    //     }

    //     $tenant->package_id = $request->package_id;
    //     $tenant->update();
    //     $tenant->run(function () use ($newAddedPermissions, $latestPermissions, $latestPermissionsIds) {

    //         // $data = $latestPermissionsIds; // P-46 exists | count 96
    //         // $data = $newAddedPermissions; // Already p-46 exists | count 46
    //         // $data = DB::table('permissions')->count(); // Already p-46 exists | count 96

    //         $prevPermissionIds = DB::table('permissions')->pluck('id')->toArray(); // Standard(2)
    //         $newAddedPermissions = [];
    //         foreach ($latestPermissions as $element) {
    //             if (!in_array($element["id"], $prevPermissionIds)) {
    //                 $newAddedPermissions[] = $element; //P-46 exists | count-42
    //             }
    //         }
    //         // dd($newAddedPermissions);
    //         if ($newAddedPermissions) {
    //             DB::table('permissions')->whereNotIn('id', $latestPermissionsIds)->delete();
    //             DB::table('permissions')->insert($newAddedPermissions);
    //             $role = Role::findById(1);
    //             $role->syncPermissions($latestPermissionsIds);
    //         }



    //         // DB::table('permissions')->whereNotIn('id', $latestPermissionsIds)->delete();
    //         // DB::table('permissions')->insert($newAddedPermissions);
    //         // $role = Role::findById(1);
    //         // $role->syncPermissions($latestPermissionsIds);
    //     });
    // }

    // sudo php artisan cache:clear
    // php artisan cache:forget spatie.permission.cache
}
