<?php

namespace App\Http\Controllers\Landlord;

use App\Contracts\BlogContract;
use App\Contracts\FaqContract;
use App\Contracts\FeatureContract;
use App\Contracts\ModuleContract;
use App\Contracts\PackageContract;
use App\Contracts\PageContract;
use App\Contracts\SocialContract;
use App\Contracts\TenantSignupDescriptionContract;
use App\Contracts\TestimonialContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUs\ContactUsRequest;
use App\Http\traits\PaymentTrait;
use App\Http\traits\PermissionHandleTrait;
use App\Mail\ContactUs;
use App\Models\Landlord\Hero;
use App\Models\Tenant;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LandingPageController extends Controller
{
    public $languageId;

    use PermissionHandleTrait;
    use PaymentTrait;

    public function __construct(
        public SocialContract $socialContract,
        public BlogContract $blogContract,
        public PageContract $pageContract
    ) {
        $this->middleware(function ($request, $next) {
            $this->languageId = Session::has('TempPublicLangId') == true ? Session::get('TempPublicLangId') : Session::get('DefaultSuperAdminLangId');

            return $next($request);
        });
    }

    public function index(
        ModuleContract $moduleContract,
        FeatureContract $featureContract,
        FaqContract $faqContract,
        TestimonialContract $testimonialContract,
        TenantSignupDescriptionContract $tenantSignupDescriptionContract,
        PackageContract $packageContract,
    ) {
        $languageId = $this->languageId;

        $socials = Cache::remember('socials', config('cache.duration'), function () {
            return $this->socialContract->getOrderByPosition();
        });

        $hero = Cache::remember('hero', config('cache.duration'), function () use ($languageId) {
            return Hero::where('language_id', $languageId)->latest()->first();
        });

        $module = Cache::remember('module', config('cache.duration'), function () use ($moduleContract, $languageId) {
            return $moduleContract->fetchLatestDataByLanguageIdWithRelation(['moduleDetails'], $languageId);
        });

        $faq = Cache::remember('faq', config('cache.duration'), function () use ($faqContract, $languageId) {
            return $faqContract->fetchLatestDataByLanguageIdWithRelation(['faqDetails'], $languageId);
        });

        $features = Cache::remember('features', config('cache.duration'), function () use ($featureContract) {
            return $featureContract->all();
        });

        $testimonials = Cache::remember('testimonials', config('cache.duration'), function () use ($testimonialContract) {
            return $testimonialContract->getOrderByPosition();
        });

        $tenantSignupDescription = Cache::remember('tenantSignupDescription', config('cache.duration'), function () use ($tenantSignupDescriptionContract, $languageId) {
            return $tenantSignupDescriptionContract->fetchLatestDataByLanguageId($languageId);
        });

        $blogs = Cache::remember('blogs', config('cache.duration'), function () use ($languageId) {
            return $this->blogContract->getAllByLanguageId($languageId);
        });

        $saasFeatures = Cache::remember('saasFeatures', config('cache.duration'), function () {
            return $this->features();
        });

        $packages = Cache::remember('packages', config('cache.duration'), function () use ($packageContract) {
            return $packageContract->getOrderByPosition();
        });

        $paymentMethods = Cache::remember('paymentMethods', config('cache.duration'), function () {
            return $this->paymentMethods();
        });

        return view('landlord.public-section.pages.landing-page.index', compact([
            'socials', 'hero', 'module', 'features', 'faq', 'testimonials', 'tenantSignupDescription',
            'blogs', 'saasFeatures', 'packages', 'paymentMethods',
        ]));
    }

    public function blog()
    {
        $languageId = $this->languageId;

        $blogs = Cache::remember('blogs', config('cache.duration'), function () use ($languageId) {
            return $this->blogContract->getAllByLanguageId($languageId);
        });

        return view('landlord.public-section.pages.blogs.index', compact('blogs'));
    }

    public function blogDetail($slug)
    {
        $blog = $this->blogContract->fetchLatestDataBySlug($slug);

        return view('landlord.public-section.pages.blogs.blog-details', compact('blog'));
    }

    public function pageDetails($slug)
    {
        $page = Cache::remember('page', config('cache.duration'), function () use ($slug) {
            return $this->pageContract->fetchLatestDataBySlug($slug);
        });

        return view('landlord.public-section.pages.pages.page-details', compact('page'));
    }

    public function contactUsSubmit(ContactUsRequest $request)
    {
        Mail::to(config('mail.from.address'))->send(new ContactUs($request));

        return redirect()->back()->with(['success' => 'Mail Sent Successfully']);
    }

    // private function test()
    // {
    //     $tenant = Tenant::create(['id' => 'bar']);
    //     $tenant->domains()->create(['domain' => 'bar'.'.'.env('CENTRAL_DOMAIN')]); // This Line
    // }

    // public function testSaas()
    // {
    //     // return response()->json('test');

    //     try {
    //         // return response()->json(['message' => 'Login successful'], 200);
    //         throw new Exception("Error Processing Request", 1);
    //     } catch (Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

}
