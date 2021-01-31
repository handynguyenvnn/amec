<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Coma;
use App\Models\ComaLanguage;
use App\Models\Language;
use App\Models\MyBackgroundPage;
use App\Models\SmallTestQuestionChoice;
use App\Models\SmallTestQuestionProblem;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\TermRequest;
use App\Repositories\Terms;
use Illuminate\Support\Facades\Storage;

/**
 * This function manage all function of Terms
 * Class TermController
 * @package App\Http\Controllers
 */
class TermController extends Controller
{

    /**
     * This function list term
     *
     * @param Terms $terms
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Terms $terms)
    {
        $languages = Language::all();
        $data = $terms->getTermsWithLanguage();
        return view('terms_of_service.list', compact('data', 'keyword', 'languages'));
    }

    /**
     * This function update Term
     *
     * @param Request $request
     * @param Terms $terms
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Terms $terms)
    {
        $data = $request->except('_token', '_method');
        $terms->updateTerm($data);
        return redirect()->route('terms_of_service.index');
    }

    /**
     * This function get terms of user by Ajax
     *
     * @param Terms $terms
     * @param $languageId
     * @return mixed
     */
    public function getAjaxTerm(Terms $terms, $languageId)
    {
        $termsOfUse = $terms->getTermsByLanguageId($languageId);
        return response()->json(['terms_of_use' => $termsOfUse]); // AJAX JS: response.terms_of_use
    }
}
