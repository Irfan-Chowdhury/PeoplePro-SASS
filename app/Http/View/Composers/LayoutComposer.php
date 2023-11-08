<?php


namespace App\Http\View\Composers;

use App\Models\Landlord\Language;
use Exception;
use Illuminate\View\View;
use JoeDixon\Translation\Drivers\Translation;

class LayoutComposer {

	private $translation;

	public function __construct(Translation $translation)
	{
		$this->translation = $translation;
	}

	public function compose(View $view)
	{
        if (in_array(request()->getHost(), config('tenancy.central_domains')))
            $languages = Language::all();
        else
            $languages = $this->translation->allLanguages();

        $view->with('languages', $languages);
	}

}
