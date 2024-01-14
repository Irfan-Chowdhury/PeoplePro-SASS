<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\StoreRequest;
use App\Http\Requests\Language\UpdateRequest;
use App\Models\Landlord\Language;
use App\Services\LanguageService;
use Illuminate\Support\Facades\File;
class LanguageController extends Controller
{
    private $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    public function index()
    {
        return view('landlord.super-admin.pages.languages.index');
    }

    public function datatable()
    {
        return $this->languageService->yajraDataTable();
    }

    public function store(StoreRequest $request)
    {
        $result = $this->languageService->storeLanguage($request);

        self::enFileCopyToNewLang($request->locale);

        return response()->json($result['alertMsg'], $result['statusCode']);
    }

    private function enFileCopyToNewLang(string $locale) : void
    {
        $sourcePath = resource_path('lang/en/file.php');
        $destinationPath = resource_path('lang/'.$locale.'/file.php');
        if (File::exists($sourcePath))
            File::copy($sourcePath, $destinationPath);

    }

    public function edit(Language $language)
    {
        return response()->json($language);
    }

    public function update(UpdateRequest $request, Language $language)
    {
        $result = $this->languageService->updateLanguage($request, $language);

        return response()->json($result['alertMsg'], $result['statusCode']);
    }

    public function destroy(Language $language)
    {
        $result = $this->languageService->deleteLanguage($language);

        return response()->json($result['alertMsg'], $result['statusCode']);
    }
}
