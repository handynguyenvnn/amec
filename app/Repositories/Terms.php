<?php

namespace App\Repositories;

use App\Http\Requests;
use App\Models\Language;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Libs\ImagePath\Process;

/**
 * This class manage all action of Terms
 * Class Terms
 * @package App\Repositories
 */
class Terms extends Repository
{
    /**
     * Terms constructor.
     */
    public function __construct()
    {
    }

    /**
     * This function get Terms by lang code
     *
     * @param $lang
     * @return array
     */
    public function getTerms($lang)
    {
        $result = DB::table('terms')
            ->join('languages', 'languages.id', 'terms.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'terms.terms_of_use AS terms'
            )
            ->get();
        return (count($result) > 0) ? $result[0]->terms : '';
    }

    /**
     * This function get all Terms
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTermsWithLanguage()
    {
        $results = Term::all();
        $arrResults= [];
        if(count($results)>0) {
            foreach ($results as $key => $result) {
                $lang = Language::find($result->language_id);
                $lang_code = (count($lang)>0) ? $lang->lang_code : '';
                $arrResults[$lang_code.'_id'] = $result->id;
                $arrResults[$lang_code.'_terms_of_use'] = $result->terms_of_use;
            }
        }
        return $arrResults;
    }

    /**
     * This function get term of user by Ajax
     *
     * @param $languageId
     * @return string
     */
    public function getTermsByLanguageId($languageId)
    {
        $result = Term::where('language_id', $languageId)->get();
        return (count($result)>0) ? $result[0]->terms_of_use : '';
    }

    /**
     * @param $input
     */
    public function updateTerm($input)
    {
       $languages = Language::all();
       if(count($languages)>0){
           foreach ($languages as $key => $language){
               if(isset($input[$language->lang_code.'_id'])){
                   $tems = Term::find($input[$language->lang_code.'_id']);
               }else{
                   $tems = new Term();
               }
               $tems->terms_of_use = isset($input[$language->lang_code.'_terms_of_use']) ?  (Process::convertURL($input[$language->lang_code.'_terms_of_use'])) : '';
               $tems->language_id = $language->id;
               $tems->save();
           }
       }
    }
}