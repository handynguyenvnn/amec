<?php

namespace App\Http\Controllers;


use App\Http\Requests\LanguageRequest;
use App\Repositories\Languages;

class LanguageController
{
    /**
     * @param Languages $languages
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Languages $languages)
    {
        $data = $languages->getAll();
        return view('language.list', compact('data'));
    }

    /**
     * @param Languages $languages
     * @param LanguageRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Languages $languages, LanguageRequest $request)
    {
        $languages->create($request->only('lang', 'lang_code'));
        return redirect(route('languages.index'));
    }

    /**
     * @param $id
     * @param Languages $languages
     * @param LanguageRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Languages $languages, LanguageRequest $request)
    {
        $languages->update($id, $request->only('lang', 'lang_code'));
        return redirect(route('languages.index'));
    }

    /**
     * @param $id
     * @param Languages $languages
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id, Languages $languages)
    {
        $languages->delete($id);
        return redirect(route('languages.index'));
    }
}