<?php

namespace App\Repositories;

use App\Models\Guide;
use App\Models\Language;
use Illuminate\Support\Facades\DB;
use App\Libs\ImagePath\Process;

/**
 * This class manage all action of Guides
 * Class Guides
 * @package App\Repositories
 */
class Guides extends Repository
{
    /**
     * Guide constructor.
     */
    public function __construct()
    {
        parent::__construct(new Guide());
    }

    /**
     * This function get guide settings with language
     * @return mixed
     */
    public function getGuideWithLanguage()
    {
        $results = Guide::all();
        $arrResults = [];
        if(count($results)>0) {
            foreach ($results as $key => $result) {
                $lang = Language::find($result->language_id);
                $lang_code = (count($lang)>0) ? $lang->lang_code : '';
                $arrResults[$lang_code.'_id'] = $result->id;
                $arrResults[$lang_code.'_html_code'] = $result->html_code;
            }
        }
        return $arrResults;
    }

    /**
     * @param $lang
     * @return mixed
     */
    public function getGuides($lang)
    {
        $result = DB::table('guides')
            ->join('languages', 'languages.id', '=', 'guides.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'guides.html_code AS guides'
            )
            ->get();
        return (count($result) > 0) ? $result[0]->guides : '';
    }

    /**
     * @param $id
     * @return string
     */
    public function getGuide($id)
    {
        $result = Guide::find($id);
        return (count($result)>0) ? $result->html_code : '';
    }
    public function updateGuide($inputs)
    {
        $languages = Language::all();
        if(count($languages)>0) {
            foreach ($languages as $key => $language) {
                if (isset($inputs[$language->lang_code.'_id'])){
                    $guides = Guide::find($inputs[$language->lang_code.'_id']);
                }else{
                    $guides = new Guide();
                }
                $guides->language_id = $language->id;
                $guides->html_code = isset($inputs[$language->lang_code.'_html_code']) ? Process::convertURL($inputs[$language->lang_code.'_html_code']) : '';
                $guides->save();
            }
        }
    }

}