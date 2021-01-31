<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Comas;

/**
 * Class ComaController
 * @package App\Http\Controllers
 */
class ComaController extends Controller
{
    /**
     * @param Comas $comas
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChapterComaByAjax(Comas $comas, $id)
    {
        $coma = $comas->getChapterComaByAjax($id);
        return response()->json($coma); // AJAX JS: 
    }
    /**
     * @param Comas $comas
     * @param $name
     * @param $chapterId
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchComaByAjax(Comas $comas, $name, $chapterId)
    {
        $coma = $comas->searchComaByAjax($name, $chapterId);
        return response()->json($coma);
    }
    /**
     * @param Comas $comas
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Comas $comas, $id)
    {
        $comas->delete($id);
        return redirect(route('chapters.index'));
    }
    /**
     * @param Request $request
     * @param Comas $comas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Comas $comas)
    {
        $comas->create($request->except('_token'));
        return redirect()->route('comas.index');
    }
    /**
     * @param Comas $comas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create( Comas $comas)
    {
        return view('comas.create');
    }
}
