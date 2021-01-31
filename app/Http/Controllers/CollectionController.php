<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Repositories\GradeNames;
use App\Repositories\Grades;
use App\Repositories\Languages;
use App\Repositories\Tags;
use App\Repositories\Tips;
use App\Repositories\TrophyRanks;
use Illuminate\Http\Request;
use App\Repositories\Collections;
use App\Repositories\Levels;
use App\Repositories\Types;
use App\Repositories\Makers;
use App\Repositories\CardAppearanceRates;
use App\Http\Requests\CollectionRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Sentinel;
use Illuminate\Support\Facades\Storage;
use App\Libs\Constants\Constant;

class CollectionController extends Controller
{
    /**
     * @param Collections $collections
     * @param Levels $levels
     * @param Types $types
     * @param Languages $languages
     * @param Request $request
     * @param CardAppearanceRates $cardAppearanceRates
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index( Collections $collections, Levels $levels, Types $types,Languages $languages,
                           Request $request, CardAppearanceRates $cardAppearanceRates)
    {
        $path_media = Constant::S3_URL . DS . Constant::S3_BUCKET_URL . DS;
        $data = $collections->search($request->all());
        $levels = $levels->getFirstFourValues();
        $rates = $cardAppearanceRates->getCardRates();
        $languages = $languages->getAll();
        $params = $request->except('current_id');
        return view('collection.list', compact('data', 'params', 'path_media', 'levels', 'languages', 'rates'));
    }

    /**
     * @param $collection_no
     * @param Collections $collections
     * @return \Illuminate\Http\JsonResponse
     */
    public function info($collection_no, Collections $collections)
    {
        $collections = $collections->getByCollectionNo($collection_no);
        return response()->json($collections);
    }

    /**
     * @param Collections $collections
     * @param Languages $languages
     * @param Makers $makers
     * @param Levels $levels
     * @param Tags $tags
     * @param Tips $tips
     * @param GradeNames $gradeNames
     * @param TrophyRanks $trophyRanks
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create( Collections $collections, Languages $languages, Makers $makers, Levels $levels, Tags $tags, Tips $tips, GradeNames $gradeNames, TrophyRanks $trophyRanks)
    {
        $languages = $languages->getAll();
        $makers = $makers->getAll();
        $levels = $levels->getFirstFourValues();
        $tags = $tags->getAll();
        $tips = $tips->getAll();
        $gradeNames = $gradeNames->getAll();
        $trophyRanks = $trophyRanks->getAll();
        return view('collection.create', compact( 'languages', 'makers', 'levels', 'tags', 'tips', 'gradeNames','trophyRanks'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param Collections $collections
     * @return \Illuminate\Http\Response
     */
    public function show($id, Collections $collections)
    {
        $data = $collections->getById($id);
        $imageFile = PUBLIC_DIR . $data->image_path;
        if (!file_exists($imageFile)) {
            $data->image_path = config('common.noImage');
        }
        return response()->json($data);
    }

    /**
     * @param $id
     * @param Collections $collections
     * @param Languages $languages
     * @param Makers $makers
     * @param Levels $levels
     * @param Tags $tags
     * @param Tips $tips
     * @param GradeNames $gradeNames
     * @param TrophyRanks $trophyRanks
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Collections $collections, Languages $languages, Makers $makers, Levels $levels, Tags $tags, Tips $tips, GradeNames $gradeNames, TrophyRanks $trophyRanks)
    {
        $data = $collections->getById($id);
        $languages = $languages->getAll();
        $makers = $makers->getAll();
        $levels = $levels->getFirstFourValues();
        $tags = $tags->getAll();
        $tips = $tips->getAll();
        $gradeNames = $gradeNames->getAll();
        $trophyRanks = $trophyRanks->getAll();
        return view('collection.edit', compact('data', 'languages', 'makers', 'levels', 'tags', 'tips', 'gradeNames','trophyRanks'));
    }


    /**
     * @param null $collection_no
     * @param Collections $collections
     * @param Languages $languages
     * @param Makers $makers
     * @param Levels $levels
     * @param Tags $tags
     * @param Tips $tips
     * @param GradeNames $gradeNames
     * @param TrophyRanks $trophyRanks
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function action($collection_no=null, Collections $collections, Languages $languages, Makers $makers, Levels $levels, Tags $tags, Tips $tips, GradeNames $gradeNames, TrophyRanks $trophyRanks)
    {
        $path_media  = Constant::S3_URL . DS . Constant::S3_BUCKET_URL . DS;
        if($collection_no) {
            $data = $collections->getByCollectionNo($collection_no);
        }else{
            $data = null;
        }
        $languages = $languages->getAll();
        $makers = $makers->getAll();
        $levels = $levels->getFirstFourValues();
        $tags = $tags->getAll();
        $tips = $tips->getAll();
        $gradeNames = $gradeNames->getAll();
        $trophyRanks = $trophyRanks->getAll();
        return view('collection.action', compact('data','path_media', 'languages', 'makers', 'levels', 'tags', 'tips', 'gradeNames','trophyRanks', 'collection_no'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $no
     * @param Request $request
     * @param Collections $collections
     * @return \Illuminate\Http\Response
     */
    public function update($no=null, Request $request, Collections $collections)
    {
        $collections->updateCollections($no, $request->except('_token','_method'), $request);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $collections->action) {
            $params = Session::get('params');
            $params['current_id'] = $no;
        }
        return redirect()->route('collections.index', $params);
    }
    /**
     * @param Request $request
     * @param Collections $collections
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Collections $collections)
    {
        $id=null;
        $collections->updateCollections($id, $request->except('_token','_method'), $request);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $collections->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return redirect()->route('collections.index', $params);
    }

    /**
     * @param $no
     * @param Collections $collections
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($no, Collections $collections)
    {
        $collections = Collection::where('collection_no', $no)->get();
        foreach ($collections as $key =>$temp_collection){
            $collection = Collection::find($temp_collection->id);
            if(count($collection)>0){
                $path = $collection->image_path;
                if (Storage::disk('s3')->exists($path)) {
                    Storage::disk('s3')->delete($path);
                }
                $collection->delete($temp_collection->id);
            }
        }

        $params = [];
        return redirect()->route('collections.index', $params);
    }

    /**
     * Update types of card appearance rate
     * @param Request $request
     * @param CardAppearanceRates $cardAppearanceRates
     * @return Redirect
     */
    public function updateCardAppearanceRate(Request $request, CardAppearanceRates $cardAppearanceRates) {
        $data = $request->except('_token');
        $data['user_id'] = Sentinel::getUser()->id;
        $cardAppearanceRates->updateCardRates($data);
        return redirect()->route('collections.index');

    }
    public function deleteImage($no){
        $collections = Collection::where('collection_no', $no)->get();
        foreach ($collections as $key =>$temp_collection){
            $collection = Collection::find($temp_collection->id);
            if(count($collection)>0){
                $path = $collection->image_path;
                if (Storage::disk('s3')->exists($path)) {
                    Storage::disk('s3')->delete($path);
                }
                $collection->image_path = '';
                $collection->save();
            }
        }
        return redirect()->route('collections.action', $no);
    }
}
