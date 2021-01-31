<?php

namespace App\Http\Controllers;

use App\Repositories\Languages;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Guides;
use App\Libs\ImagePath\Process;
use Illuminate\Support\Facades\DB;

/**
 * Class GuideController
 * @package App\Http\Controllers
 */
class GuideController extends Controller
{

    /**
     * @param Guides $guides
     * @param $languages
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index( Guides $guides, Languages $languages)
    {
        $data = $guides->getGuideWithLanguage();
        $languages = $languages->getAll();
        return view('guide.list', compact('data', 'languages','keyword'));
    }

    /**
     * @param Request $request
     * @param Guides $guides
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( Request $request, Guides $guides)
    {
        $data = $request->except('_token', '_method');
        $guides->updateGuide($data);
        return redirect()->route('guides.index');
    }

    /**
     * @param Guides $guides
     * @param $languageId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAjax( Guides $guides, $id)
    {
        $guides = $guides->getGuide($id);
        return response()->json(['html_code' => $guides]); // AJAX JS: response.html_code
    }

}
