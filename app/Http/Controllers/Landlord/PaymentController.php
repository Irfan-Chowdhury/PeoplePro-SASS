<?php

namespace App\Http\Controllers\Landlord;

use App\Contracts\PageContract;
use App\Contracts\SocialContract;
use App\Http\Controllers\Controller;
use App\Http\traits\PermissionHandleTrait;
use App\Models\Landlord\Package;
use App\Models\Landlord\Payment;
use App\Models\Tenant;
use App\Services\PaymentService;
use App\Services\TenantService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public $languageId;
    use PermissionHandleTrait;
    public function __construct(
        public SocialContract $socialContract,
        public PageContract $pageContract,
        public PaymentService $paymentService,
        public TenantService $tenantService
    ){
        $this->middleware(function ($request, $next){
            $this->languageId = Session::has('TempPublicLangId')==true ? Session::get('TempPublicLangId') : Session::get('DefaultSuperAdminLangId');
            return $next($request);
        });
    }

    public function paymentPayPage($paymentMethod, Request $request)
    {
        $tenantRequestData = json_encode($request->all());
        $totalAmount = $request->session()->get('price');

        $socials = $this->socialContract->getOrderByPosition(); //Common
        $pages =  $this->pageContract->getAllByLanguageId($this->languageId); //Common

        switch ($paymentMethod) {
            case 'stripe':
                return view('landlord.public-section.pages.payment.stripe',compact('socials', 'pages','paymentMethod','tenantRequestData','totalAmount'));
            default:
                break;
        }
    }

    public function paymentAndTenantManage($paymentMethod, Request $request)
    {
        DB::beginTransaction();
        try {
            $paymentRequestData = $request->except('tenantRequestData');
            $tenantRequestData = json_decode(str_replace('&quot;', '"', $request->tenantRequestData));

            $payment = self::paymentPayConfirm($paymentMethod, $tenantRequestData, $paymentRequestData);
            self::tenantHandle($tenantRequestData, $payment);

            DB::commit();
            return response()->json('ok');
        }
        catch (Exception $e) {
            DB::rollback();

            if(request()->ajax())
                return response()->json(['errorMsg' => $e->getMessage()], 422);
            else
                return redirect()->back()->withErrors(['errors' => [$e->getMessage()]]);
        }
    }

    protected function paymentPayConfirm($paymentMethod, $tenantRequestData, $paymentRequestData)
    {
        $payment = $this->paymentService->initialize($paymentMethod);
        return $payment->pay($tenantRequestData, $paymentRequestData);
    }

    protected function tenantHandle($tenantRequestData, $payment) : void
    {
        $tenant = Tenant::find($tenantRequestData->tenant_id);
        $package = Package::find($tenantRequestData->package_id);
        $this->tenantService->permissionUpdate($tenant, $tenantRequestData, $package);

        Payment::where('id', $payment->id)->update(['tenant_id'=> $tenantRequestData->tenant_id]);
    }

    public function paymentPayCancel($paymentMethod, PaymentService $paymentService)
    {
        $payment = $paymentService->initialize($paymentMethod);
        return $payment->cancel();
    }


}