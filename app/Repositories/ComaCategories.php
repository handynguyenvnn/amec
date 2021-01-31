<?php

namespace App\Repositories;

use App\Libs\Constants\Constant;
use App\Models\Coma;
use App\Models\ComaCategory;
use App\Models\ComaLanguage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Language;

/**
 * This class manage all function of ComaCategories
 * Class ComaCategories
 * @package App\Repositories
 */
class ComaCategories extends Repository
{
    public $action = 'coma_category';

    /**
     * ComaCategory constructor.
     */
    public function __construct()
    {
        parent::__construct(new ComaCategory());
    }

    public function search(array $params)
    {
        // Set sort and paginate
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';
        $this->query = DB::table('coma_categories')
            ->where('language_id', Constant::LANG_JA_ID);
        // Start search query
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['frame_category_name'])) {
            $this->query->where('frame_category_name', 'LIKE', '%' . $params['frame_category_name'] . '%');
        }

        // set older page before update action
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }

        // Set session search params
        Session::put('params', $params);

        return $this->query->paginate($perPage);
    }
    public function getByNo($no){
        $coma_categories = ComaCategory::where('coma_category_no', $no)->get();
        $arrName = [];
        foreach ($coma_categories as $key => $coma_category){
            $langs = Language::find($coma_category->language_id);
            if(count($langs)>0){
                $lang_code = $langs->lang_code;
                $arrName[$lang_code.'_id'] = $coma_category->id;
                $arrName[$lang_code.'_frame_category_name'] = $coma_category->frame_category_name;
                $arrName['coma_category_no'] = $coma_category->coma_category_no;
            }
        }
        return $arrName;
    }
    public function createComaCategory(array $input){
        $languages = Language::all();
        $no = ComaCategory::orderBy('coma_category_no','desc')->first();
        if(!$no){
            $no =  1;
        }
        if(count($no)>0){
            $no =  (int)$no->coma_category_no + 1;
        }
        foreach ($languages as $key => $language){
            if( isset( $input[$language->lang_code.'_frame_category_name'])){
                if (isset($input[$language->lang_code.'_id'])) {
                    $coma_categories = ComaCategory::find($input[$language->lang_code . '_id']);
                }else{
                    $coma_categories = new ComaCategory();
                }
                if(isset($input['coma_category_no'])){
                    $coma_categories->coma_category_no = $input['coma_category_no'];
                }else{
                    $coma_categories->coma_category_no = $no;
                }
                $coma_categories->frame_category_name = $input[$language->lang_code.'_frame_category_name'];
                $coma_categories->language_id = $language->id;
                $coma_categories->save();
            }
        }
    }

    public function get($language_id)
    {

         $results['notes'] = ComaCategory::where('language_id', $language_id)
            ->select( 'coma_category_no', 'frame_category_name AS title')->get();
        $results['comas'] = $this->getComa($language_id);
        return $results;
    }
    private function getComa($language_id)
    {
        $arrResult = [];
        $results = DB::table('grades')
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('comas', 'comas.chapter_id', 'chapters.id')
            ->join('coma_categories', 'comas.coma_category_id', 'coma_categories.id')
            ->join('coma_languages', 'coma_languages.coma_id', 'comas.id')
            ->join('languages', 'languages.id', 'coma_languages.language_id')
            ->where('versions.published', Constant::PUBLISHED)
            ->where('coma_languages.language_id', $language_id)
            ->select(
                'comas.frame_name as name',
                'comas.id as id',
                'comas.chapter_id as chapter_id',
                'comas.updated_at as date',
                'comas.frame_no  as frame_no',
                'coma_categories.coma_category_no as coma_category_no',
                'coma_languages.id as coma_language_id',
                'coma_languages.priority_check as priority_check',
                'coma_languages.music_path as music_link',
                'coma_languages.image_path as picture_link',
                'coma_languages.video_path as video_link',
                'coma_languages.description as description'
            )
            ->get();
        foreach ($results as $key => $result) {
            if ($result->priority_check == 0) {
                $coma_languages = ComaLanguage::where('priority_check', Constant::PRIORITY_CHECK_ON)
                    ->where('coma_id', $result->id)
                    ->first();
                $music_link = (count($coma_languages) > 0) ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$coma_languages->music_path : Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$result->music_link;
                $picture_link = (count($coma_languages) > 0) ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$coma_languages->image_path : Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$result->picture_link;
                $video_link = (count($coma_languages) > 0) ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$coma_languages->video_path : Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$result->video_link;
            } else {
                $music_link = Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$result->music_link;
                $picture_link = Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$result->picture_link;
                $video_link = Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$result->video_link;
            }
            $arrResult[$key] = array(
                'name' => $result->name,
                'id' => $result->id,
                'chapter_id' => $result->chapter_id,
                'date' => $result->date,
                'frame_no' => $result->frame_no,
                'coma_category_no' => $result->coma_category_no,
                'coma_language_id' => $result->coma_language_id,
                'priority_check' => $result->priority_check,
                'music_link' => $music_link,
                'picture_link' => $picture_link,
                'video_link' => $video_link,
                'description' => $result->description
            );
        }
        return $arrResult;
    }

    public function fetchALl($languageId)
    {
        return DB::table('coma_categories')
            ->join('comas', 'comas.coma_category_id', 'coma_categories.id')
            ->join('coma_languages', 'coma_languages.coma_id', 'comas.id')
            ->where('coma_languages.language_id', $languageId)
            ->select(
                'comas.id AS id',
                'comas.chapter_id AS chapter_id',
                'comas.frame_name AS frame_name',
                'comas.frame_no AS frame_no',
                'comas.coma_category_id AS coma_category_id',
                'comas.folder_id AS folder_id',
                'comas.file_id AS file_id',
                'comas.control_no AS control_no',
                'comas.frame_no AS frame_no',
                'coma_categories.id AS coma_category_id',
                'coma_categories.frame_category_name AS frame_category_name',
                'coma_languages.id AS coma_language_id',
                'coma_languages.coma_id AS coma_id',
                'coma_languages.music_path AS music_path',
                'coma_languages.description AS description',
                'coma_languages.language_id AS language_id',
                'coma_languages.video_path AS video_path',
                'coma_languages.priority_check AS priority_check',
                'coma_languages.music_path AS music_path',
                'coma_languages.file_id AS file_id',
                'coma_languages.image_path AS image_path'
            )
            ->get();
    }

    public function processExportXML($languageId)
    {
        $lang = count(Language::find($languageId)) > 0 ? Language::find($languageId)->lang_code : '';
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>' . '<共通 lang="' . $lang . '" />');
        $comas = Coma::all();
        if(count($comas)>0) {
            foreach ($comas as $key_com => $v_coma) {
                $coma_languages = ComaLanguage::where('coma_id', $v_coma->id)
                    ->where('language_id', $languageId)->first();
                if (count($coma_languages) > 0) {
                    $coma = $xml->addChild('コマ' . ++$key_com);
                    $coma_image = $coma->addChild('画像', $coma_languages->image_path);
                    $coma_video = $coma->addChild('動画', $coma_languages->video_path);
                    if ($coma_languages->priority_check == 0) {
                        $priority_check = 'false';
                    } else {
                        $priority_check = 'true';
                    }
                    $coma_image->attributes('優先チェック', $priority_check);
                    $coma_video->attributes('優先チェック', $priority_check);
                    $coma->addChild('音楽', $coma_languages->music_path);
                    $coma->addChild('説明', $coma_languages->description);
                }

            }
        }
        return $xml->asXML();
    }


    public function processImportXML($inputs)
    {
//        print_r($inputs['コマカテゴリ']);
//        exit;
        foreach ($inputs['コマカテゴリ'] as $key => $temp) {
            print_r($temp['コマ']['@attributes']['chapter_id']);
//        exit;
            $coma_category_check_exists = ComaCategory::find($temp['@attributes']['id']);
            if ($coma_category_check_exists == null) {
                $coma_categories = new ComaCategory();
            } else {
                $coma_categories = ComaCategory::find($temp['@attributes']['id']);
            }
            $coma_categories->id = $temp['@attributes']['id'];
            $coma_categories->frame_category_name = $temp['@attributes']['frame_category_name'];
            $coma_categories->save();
            $coma_check_exists = Coma::find($temp['コマ']['@attributes']['id']);
            if ($coma_check_exists == null) {
                $comas = new Coma();
            } else {
                $comas = Coma::find($temp['コマ']['@attributes']['id']);
            }
            $comas->id = $temp['コマ']['@attributes']['id'];
            $comas->chapter_id = $temp['コマ']['@attributes']['chapter_id'];
            $comas->frame_name = $temp['コマ']['@attributes']['frame_name'];
            $comas->frame_no = $temp['コマ']['@attributes']['frame_no'];
            $comas->coma_category_id = $temp['コマ']['@attributes']['coma_category_id'];
            $comas->file_id = $temp['コマ']['@attributes']['file_id'];;
            $comas->folder_id = $temp['コマ']['@attributes']['folder_id'];
            $comas->control_no = $temp['コマ']['@attributes']['control_no'];
            $comas->save();
            $coma_language_check_exists = ComaLanguage::find($temp['コマ']['コマ言語']['@attributes']['id']);
            if ($coma_language_check_exists == null) {
                $coma_languages = new ComaLanguage();
            } else {
                $coma_languages = ComaLanguage::find($temp['コマ']['コマ言語']['@attributes']['id']);
            }
            $coma_languages->id = $temp['コマ']['コマ言語']['@attributes']['id'];
            $coma_languages->coma_id = $temp['コマ']['コマ言語']['@attributes']['coma_id'];
            $coma_languages->music_path = $temp['コマ']['コマ言語']['@attributes']['music_path'];
            $coma_languages->description = $temp['コマ']['コマ言語']['@attributes']['description'];
            $coma_languages->language_id = $temp['コマ']['コマ言語']['@attributes']['language_id'];;
            $coma_languages->video_path = $temp['コマ']['コマ言語']['@attributes']['video_path'];
            $coma_languages->priority_check = $temp['コマ']['コマ言語']['@attributes']['priority_check'];
            $coma_languages->file_id = $temp['コマ']['コマ言語']['@attributes']['file_id'];
            $coma_languages->image_path = $temp['コマ']['コマ言語']['@attributes']['image_path'];
            $coma_languages->save();
        }
    }
}