<?php

namespace App\Repositories;

use App\Models\CardAppearanceRate;
use App\Models\Collection;
use App\Models\Language;
use App\Models\PossessionCollection;
use Illuminate\Support\Facades\DB;
use App\Models\Type;
use App\Models\Maker;
use App\Models\Tag;
use App\Libs\Constants\Constant;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

/**
 * This class manage all function in collections
 * Class Collections
 * @package App\Repositories
 */
class Collections extends Repository
{
    /**
     * Collections constructor.
     */
    public $action = 'collections';

    public function __construct()
    {
        parent::__construct(new Collection());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function infoById($id){
        $result = DB::table('collections')
            ->join('languages', 'languages.id', '=', 'collections.language_id')
            ->join('makers', 'makers.id', '=', 'collections.maker_id')
            ->where('collections.id', $id)
            ->select(
                'languages.lang AS lang',
                'makers.name AS maker_name',
                'collections.name AS name',
                'collections.description AS description',
                'collections.image_path AS image_path',
                'collections.youtube_link AS youtube_link'
            )
            ->get();
        return (count($result)>0 ? $result[0]: '');
    }
    public function getByCollectionNo($collection_no){
        $collections = Collection::where('collection_no', $collection_no)->get();
        $arrCollection = [];
        foreach ($collections as $key => $collection){
            $lang_code = Language::find($collection->language_id);
            if (count($lang_code)>0){
                $lang_code = $lang_code->lang_code;
                $arrCollection[$lang_code.'_id'] = $collection->id;
                $arrCollection[$lang_code.'_name'] = $collection->name;
                $arrCollection[$lang_code.'_language_id'] = $collection->language_id;
                $arrCollection[$lang_code.'_description'] = $collection->description;
                if($collection->language_id == Constant::LANG_JA_ID) {
                    $arrCollection['collection_no'] = $collection->collection_no;
                    $arrCollection['maker_id'] = $collection->maker_id;
                    $arrCollection['maker_name'] = Maker::find($collection->maker_id)->name;
                    $arrCollection['level_id'] = $collection->level_id;
                    $arrCollection['image_path'] = $collection->image_path;
                    $arrCollection['type_id'] = $collection->type_id;
                    $arrCollection['youtube_link'] = $collection->youtube_link;
                }
            }
        }
       return $arrCollection;
    }


    public function updateCollections($no=null, array $input, $image = null)
    {
        $year = date('Y');
        $month = date('m');
        if($no) {
            $collection_no = $input['collection_no'];
            if($no < $input['collection_no']){
                $all_collections = Collection::all();
                if(count($all_collections)>0) {
                    foreach ($all_collections as $all_collection) {
                        if ((intval($all_collection->collection_no) > $no) && (intval($all_collection->collection_no) <= intval($input['collection_no']))) {
                            $other_collection = Collection::find($all_collection->id);
                            $other_collection->collection_no = $all_collection->collection_no - 1;
                            $other_collection->save();
                        }
                    }
                }
            }else{
                $all_collections = Collection::all();
                if(count($all_collections)>0) {
                    foreach ($all_collections as $all_collection) {
                        if ((intval($all_collection->collection_no) < $no) && (intval($all_collection->collection_no) >= intval($input['collection_no']))) {
                            $other_collection = Collection::find($all_collection->id);
                            $other_collection->collection_no = $all_collection->collection_no + 1;
                            $other_collection->save();
                        }



                    }
                }
            }
        }elseif($no > $input['collection_no']){
            $collection_no = $input['collection_no'];
            $all_collections = Collection::all();
            if(count($all_collections)>0) {
                foreach ($all_collections as $all_collection) {
                    if ((intval($all_collection->collection_no) >= intval($input['collection_no']))) {
                        $other_collection = Collection::find($all_collection->id);
                        $other_collection->collection_no = $all_collection->collection_no + 1;
                        $other_collection->save();
                    }
                }
            }
        }else{
            $collection_no = $input['collection_no'];
        }
        $languages = Language::all();
        foreach ($languages as $key => $language){
            if(isset($input[$language->lang_code.'_id'])){
                $collections =  Collection::find($input[$language->lang_code.'_id']);
            }else{
                $collections = new Collection();
            }
            $collections->name = $input[$language->lang_code.'_name'];
            $collections->language_id = $language->id;
            $collections->level_id = $input['level_id'];
            $collections->description = $input[$language->lang_code.'_description'];
            $collections->youtube_link = $input['youtube_link'];
            $collections->maker_id = $input['maker_id'];
            $collections->collection_no = $collection_no;
            if($image) {
                if ($image->file('image_path')) {
                    $image_path = $image->file('image_path');
                    $nameImage = str_random(15) . pathinfo($image_path)['filename'];
                    $extImage = $image_path->guessClientExtension();
                    if (Storage::disk('s3')->putFileAs('image/collections/'.$year.DS.$month, $image_path, "{$nameImage}.{$extImage}", "public")) {
                        $collections->image_path = 'image/collections/'.$year.DS.$month . DS . $nameImage . '.' . $extImage;
                    } else {
                        $collections->image_path = Constant::NO_IMAGE;
                    }
                }
                else{
                    if(isset($input['ja_id'])) {
                        $find_image_path = Collection::find($input['ja_id']);
                        $collections->image_path = (count($find_image_path) > 0) ? $find_image_path->image_path : '';
                    }
                }
            }
            $collections->save();
        }
    }

    /**
     * search collection
     * @param $params
     * @return mixed
     */
    public function search($params)
    {
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'collection_no';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'asc';
        $this->query = DB::table('collections')
            ->join('levels', 'collections.level_id', 'levels.id' )
            ->where('language_id', Constant::LANG_JA_ID)
            ->select('levels.name AS level_name',
            'collections.name AS name',
            'collections.collection_no AS collection_no',
            'collections.id AS id');
        if (isset($params['name'])) {
            $this->query->where('collections.name', 'LIKE', '%' . $params['name'] . '%');
        }
        if (isset($params['level_id'])) {
            $this->query->where('collections.level_id', $params['level_id']);
        }
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }

    /**
     * This function get all collection were trophy
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTrophy()
    {
        return Collection::get();
    }

    /**
     * This function get collection by type id
     * @param $lang
     * @param $userId
     * @param $typeId
     * @return mixed
     */
    private function getCollectionByLevelId($lang, $userId, $typeId)
    {
        $res = DB::table('collections')
            ->join('possession_collections', 'possession_collections.collection_id', '=', 'collections.collection_no')
            ->join('languages', 'languages.id', '=', 'collections.language_id')
            ->join('makers', 'makers.id', '=', 'collections.maker_id')
            ->join('types', 'types.id', '=', 'collections.type_id')
            ->join('tags', 'tags.id', '=', 'collections.tag_id')
            ->where('collections.type_id', $typeId)
            ->where('possession_collections.user_id', $userId)
            ->where('languages.lang_code', $lang)
            ->select(
                'collections.name as name',
                'collections.collection_no as id',
                'collections.grade_id as grade_id',
                'collections.type_id as type_id',
                'collections.image_path as picture_link',
                'collections.youtube_link as video_link',
                'collections.description as description',
                'makers.name as maker',
                'types.name as type',
                'tags.name as tag'
            )
            ->get();
        return $res;
    }

    /**
     * This function get all collection
     * @param $lang
     * @param $userId
     * @return array
     */
    public function getCollection($lang, $userId)
    {
        $result = DB::table('collections')
            ->join('languages', 'languages.id', 'collections.language_id')
            ->join('makers', 'makers.id', 'collections.maker_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'collections.id AS collection_id',
                'collections.name AS name',
                'collections.collection_no AS collection_no',
                'collections.image_path AS picture_link',
                'collections.youtube_link AS video_link',
                'collections.description AS description',
                'makers.name AS maker',
                'makers.id AS maker_id'
            )
            ->get();
        $arrayResult = array();
        foreach ($result as $key => $item) {
            $arrayResult [$key]['name'] = $item->name;
            $arrayResult [$key]['collection_no'] = $item->collection_no;
            $arrayResult [$key]['picture_link'] = $item->picture_link ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$item->picture_link : '';
            $arrayResult [$key]['video_link'] = $item->video_link;
            $arrayResult [$key]['description'] = $item->description;
            $arrayResult [$key]['maker'] = $item->maker;
            $arrayResult [$key]['maker_id'] = $item->maker_id;
            $arrayResult [$key]['possession'] = $this->checkExitsPossessionCollections($userId, $item->collection_no);

        }
        return $arrayResult;
    }

    /**
     * @param $userId
     * @param $collectionId
     * @return bool
     */
    private function checkExitsPossessionCollections($userId, $collectionId)
    {
        $result = PossessionCollection::where('user_id', $userId)->where('collection_id', $collectionId)->get();
        if (count($result) > 0) {
            return true;
        } else
            return false;
    }

    /**
     * This function get all collection in array
     * @param $arrayCollectionId
     * @param $lang
     * @return mixed
     */
    private function getCollectionNotExistInArray( $arrayCollectionId, $lang)
    {
        $result = DB::table('collections')
            ->join('languages', 'languages.id', 'collections.language_id')
            ->join('makers', 'makers.id', 'collections.maker_id')
            ->where('languages.lang_code', $lang)
            ->whereNotIn('collections.collection_no', $arrayCollectionId)
            ->inRandomOrder()->take(1)
            ->select(
                'collections.collection_no AS id',
                'collections.name AS name',
                'collections.maker_id AS maker_id',
                'collections.language_id AS language_id',
                'collections.level_id AS level_id',
                'collections.description AS description',
                'collections.image_path AS image_path',
                'collections.youtube_link AS youtube_link',
                'languages.lang AS lang',
                'collections.updated_at as updated_at'
            )->get();
        return $result;

    }

    /**
     * This function get a collections not exist in possession collections
     * @param $userId
     * @param $lang
     * @return bool
     */
    private function getCollectionNotExist( $userId, $lang)
    {
        $possessionCollection = DB::table('possession_collections')
            ->where('user_id', $userId)->select('collection_id')->get();
        $arrayCollectionId = array();
        foreach ($possessionCollection as $key => $temp) {
            $arrayCollectionId[$key] = $temp->collection_id;
        }
        $result = $this->getCollectionNotExistInArray($arrayCollectionId, $lang);
        if (count($result) > 0) {
            return $result[0];
        } else
            return false;
    }

    /**
     * This function get Possession Collection
     * @param $collectionId
     * @param $userId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getPossessionCollection($collectionId, $userId)
    {
        $res = PossessionCollection::where('collection_id', $collectionId)
            ->where('user_id', $userId)
            ->select('id', 'user_id', 'collection_id')->get();
        return $res;
    }

    /**
     * This function drop possession collection
     * @param $collectionId
     * @param $userId
     * @return array|bool
     */
    public function destroyPossessionCollection($collectionId, $userId)
    {
        $result = $this->getPossessionCollection($collectionId, $userId);
        if (!$result) {
            return false;
        } else {
            $dataDrop = PossessionCollection::where('collection_id', $collectionId)
                ->where('user_id', $userId);
            if (!$dataDrop->delete()) {
                return false;
            }
            return $result;
        }
    }

    /**
     * This is function save collection
     * @param $userId
     * @param $lang
     * @return array|bool
     */
    public function saveCollection($userId, $lang)
    {
        $card_appearance_rate_1 =  CardAppearanceRate::where('level_id', Constant::LEVEL_ID_1 )->first();
        $occurrence_rate_level_1 = (count($card_appearance_rate_1)>0) ? (int)($card_appearance_rate_1->occurrence_rate) : 0;
        $card_appearance_rate_2 =  CardAppearanceRate::where('level_id', Constant::LEVEL_ID_2 )->first();
        $occurrence_rate_level_2 = (count($card_appearance_rate_2)>0) ? (int)($card_appearance_rate_2->occurrence_rate) : 0;
        $card_appearance_rate_3 =  CardAppearanceRate::where('level_id', Constant::LEVEL_ID_3 )->first();
        $occurrence_rate_level_3 = (count($card_appearance_rate_3)>0) ? (int)($card_appearance_rate_3->occurrence_rate) : 0;
        $card_appearance_rate_4 =  CardAppearanceRate::where('level_id', Constant::LEVEL_ID_3 )->first();
        $occurrence_rate_level_4 = (count($card_appearance_rate_4)>0) ? (int)($card_appearance_rate_4->occurrence_rate) : 0;
        $sumAll = $occurrence_rate_level_1 + $occurrence_rate_level_2 + $occurrence_rate_level_3 + $occurrence_rate_level_4;
        $sum1 = $occurrence_rate_level_1 + $occurrence_rate_level_2;
        $sum2 = $occurrence_rate_level_1 + $occurrence_rate_level_2 + $occurrence_rate_level_3;
        $random = rand(0, $sumAll);
        if($random <= $occurrence_rate_level_1){
            $collection = DB::table('collections')
                ->join('languages', 'languages.id', 'collections.language_id')
                ->where('level_id', Constant::LEVEL_ID_1)
                ->join('makers', 'makers.id', 'collections.maker_id')
                ->where('languages.lang_code', $lang)
                ->inRandomOrder()->take(1)
                ->select(
                    'collections.collection_no AS collection_no',
                    'collections.name AS name',
                    'collections.maker_id AS maker_id',
                    'collections.language_id AS language_id',
                    'collections.level_id AS level_id',
                    'collections.description AS description',
                    'collections.image_path AS image_path',
                    'collections.youtube_link AS youtube_link',
                    'languages.lang AS lang',
                    'collections.updated_at as updated_at'
                )->get();
        }
        if(( $occurrence_rate_level_1 < $random) && ($random <= $sum1)){
            $collection = DB::table('collections')
                ->join('languages', 'languages.id', 'collections.language_id')
                ->where('level_id', Constant::LEVEL_ID_2)
                ->join('makers', 'makers.id', 'collections.maker_id')
                ->where('languages.lang_code', $lang)
                ->inRandomOrder()->take(1)
                ->select(
                    'collections.collection_no AS collection_no',
                    'collections.name AS name',
                    'collections.maker_id AS maker_id',
                    'collections.language_id AS language_id',
                    'collections.level_id AS level_id',
                    'collections.description AS description',
                    'collections.image_path AS image_path',
                    'collections.youtube_link AS youtube_link',
                    'languages.lang AS lang',
                    'collections.updated_at as updated_at'
                )->get();
        }
        if(( $sum1 < $random) && ($random <= $sum2)){
            $collection = DB::table('collections')
                ->join('languages', 'languages.id', 'collections.language_id')
                ->where('level_id', Constant::LEVEL_ID_3)
                ->join('makers', 'makers.id', 'collections.maker_id')
                ->where('languages.lang_code', $lang)
                ->inRandomOrder()->take(1)
                ->select(
                    'collections.collection_no AS collection_no',
                    'collections.name AS name',
                    'collections.maker_id AS maker_id',
                    'collections.language_id AS language_id',
                    'collections.level_id AS level_id',
                    'collections.description AS description',
                    'collections.image_path AS image_path',
                    'collections.youtube_link AS youtube_link',
                    'languages.lang AS lang',
                    'collections.updated_at as updated_at'
                )->get();
        }
        if(( $sum2 < $random) && ($random <= $sumAll)){
            $collection = DB::table('collections')
                ->join('languages', 'languages.id', 'collections.language_id')
                ->where('level_id', Constant::LEVEL_ID_4)
                ->join('makers', 'makers.id', 'collections.maker_id')
                ->where('languages.lang_code', $lang)
                ->inRandomOrder()->take(1)
                ->select(
                    'collections.collection_no AS collection_no',
                    'collections.name AS name',
                    'collections.maker_id AS maker_id',
                    'collections.language_id AS language_id',
                    'collections.level_id AS level_id',
                    'collections.description AS description',
                    'collections.image_path AS image_path',
                    'collections.youtube_link AS youtube_link',
                    'languages.lang AS lang',
                    'collections.updated_at as updated_at'
                )->get();
        }
        $dataSave = (count($collection)>0) ? $collection[0] : '';
            $result = array(
                "name" => $dataSave->name,
                "collection_no" => $dataSave->collection_no,
                "picture_link" => $dataSave->image_path ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$dataSave->image_path : '',
                "video_link" => $dataSave->youtube_link ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$dataSave->youtube_link : '',
                "description" => $dataSave->description,
                "maker_id" => $dataSave->maker_id,
                "maker" => Maker::find($dataSave->maker_id)->name,
            );
            $this->savePossessionCollection($userId, $dataSave->collection_no);
            return $result;
    }

    /**
     * This function save possession collection
     * @param $userId
     * @param $dataId
     * @return bool
     */
    private function savePossessionCollection($userId, $collectionId)
    {
        $possessionCollection = new PossessionCollection;
        $possessionCollection->user_id = $userId;
        $possessionCollection->collection_id = !(empty($collectionId)) ? $collectionId : 0;
        return $possessionCollection->save();
    }

    /**
     * This function get name type by id
     * @param $id
     * @return string
     */
    private function getNameTypeById($id)
    {
        return Type::find($id)->get()[0]->name;

    }

    /**
     * This function get name maker by id
     * @param $id
     * @return string
     */
    private function getNameMakerById($id)
    {
        $maker = Maker::find($id);
        if(count($maker)>0) {
            return $maker->get()[0]->name;
        }else
            return Constant::NOT_AVAILABLE;
    }

    /**
     * This function get name tag by id
     * @param $id
     * @return string
     */
    private function getNameTagById($id)
    {
        $tag = Tag::find($id);
        if(count($tag)>0) {
            return $tag->get()[0]->name;
        }else
            return Constant::NOT_AVAILABLE;
    }

}