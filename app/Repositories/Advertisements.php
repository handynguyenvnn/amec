<?php

namespace App\Repositories;

use App\Models\Ad;
use App\Models\AdVideo;
use App\Models\Version;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Libs\Constants\Constant;


class Advertisements extends Repository
{
    /**
     * Advertisements constructor.
     */
    public $action = 'advertisements';
    public function __construct()
    {
        parent::__construct(new Ad());
    }
    /**
     * This function get all Advertisements
     * @return array
     */
    public function getAds(){
        $result = DB::table('ads')
            ->join('ad_videos', 'ads.id', 'ad_videos.ad_id')
            ->select(
                        'ads.id as id',
                        'ad_videos.id as ad_video_id',
                        'ads.banner_ad AS banner_ad',
                        'ads.gacha_ad AS gacha_ad',
                        'ads.content_ad AS content_ad',
                        'ad_videos.image_animation_path AS video_link'
                )
            ->get();
        $arrayResult= array();
        foreach ( $result as $key =>$temp){
            $arrayResult[$key]['id'] = $temp->id;
            $arrayResult[$key]['ad_video_id'] = $temp->ad_video_id;
            $arrayResult[$key]['banner_ad'] = ($temp->banner_ad == 0) ? 'false':'true';
            $arrayResult[$key]['gacha_ad'] = ($temp->gacha_ad == 0) ? 'false':'true';
            $arrayResult[$key]['content_ad'] = ($temp->content_ad == 0) ? 'false':'true';
            $arrayResult[$key]['video_link'] = Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$temp->video_link;

        }
        return $arrayResult;
    }
    public function updateAds( $id, $input){
        if($id) {
            $ads = Ad::find($id);
        }else{
            $ads = new Ad();
        }
        $ads->banner_ad = $input['banner_ad'];
        $ads->gacha_ad = $input['gacha_ad'];
        $ads->content_ad = $input['content_ad'];
        $ads->save();
        $year = date('Y');
        $month = date('m');
        for($i=0; $i<=(int)$input['totalAds']; $i++) {
            if (isset($input['ad_video_' . $i])) {
                $ad_videos = AdVideo::find($input['ad_video_' . $i]);
            } else {
                $ad_videos = new AdVideo();
            }
            if (isset($input['image_path_' . $i])) {
                $image_path = $input['image_path_' . $i];
                $nameImage = str_random(15) . pathinfo($image_path)['filename'];
                    $extImage = $image_path->guessClientExtension();
                    if (Storage::disk('s3')->putFileAs('image/ads/'.$year.DS.$month, $image_path, "{$nameImage}.{$extImage}", "public")) {
                        $ad_videos->image_animation_path = 'image/ads/'.$year.DS.$month . DS . $nameImage . '.' . $extImage;
                    } else {
                        $ad_videos->image_animation_path = Constant::NO_IMAGE;
                    }
            }
            $ad_videos->ad_id = $ads->id;
            $ad_videos->save();
        }
    }
    /**
     * @param array $params
     * @return mixed
     */
    public function search(array $params)
    {
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';
        $this->query = DB::table('ads')
            ->join('ad_videos', 'ads.id', 'ad_videos.ad_id')
            ->select(
                'ads.id AS id', 'ad_videos.image_animation_path AS image',
                'ads.banner_ad AS banner_ad', 'ads.gacha_ad AS gacha_ad', 'ads.content_ad AS content_ad');
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['banner_ad'])) {
            $this->query->where('banner_ad',$params['banner_ad']);
        }
        if (isset($params['gacha_ad'])) {
            $this->query->where('gacha_ad',$params['gacha_ad']);
        }
        if (isset($params['content_ad'])) {
            $this->query->where('content_ad',$params['content_ad']);
        }
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }
    public function getAdvertisementById($id)
    {
        $result = DB::table('ads')
            ->join('ad_videos', 'ads.id', 'ad_videos.ad_id')
            ->where('ad_videos.ad_id', $id)
            ->get();
        $arrayResult = array();
        foreach ($result as $key => $item){
            $arrayResult['id'] = $item->ad_id;
            $arrayResult['banner_ad'] = $item->banner_ad;
            $arrayResult['gacha_ad'] = $item->gacha_ad;
            $arrayResult['content_ad'] = $item->content_ad;
            $arrayResult['image'][$key] = $item->image_animation_path;
        }
        return $arrayResult;
    }
    public function getAdvertisementFirst()
    {
        $ad = Ad::first();
        $arrayResult = array();
        if(!count($ad)>0){
            return $arrayResult;
        }else{
            $adId = $ad->id;
            $ad_videos = AdVideo::where('ad_id', $adId)->get();
            if (count($ad_videos)>0) {
                foreach ($ad_videos as $key => $item) {
                    $arrayResult['id'] = $ad->id;
                    $arrayResult['banner_ad'] = $ad->banner_ad;
                    $arrayResult['gacha_ad'] = $ad->gacha_ad;
                    $arrayResult['content_ad'] = $ad->content_ad;
                    $extension =  explode(".", strtolower($item->image_animation_path));
                    $arrayResult['collection'][$key] = array(
                        'id' => $item->id,
                        'path' => $item->image_animation_path,
                        'extension' => end($extension)
                );
                }
            }
            return $arrayResult;
        }
    }
    public function deleteVersionByGradeId($gradeId)
    {
        $version = Version::where('grade_id', $gradeId);
        $version->delete();
    }
    public function deleteAds($id)
    {
        $ads = AdVideo::find($id);
        if (count($ads)>0) {
            $path = $ads->image_animation_path;
            if (Storage::disk('s3')->exists($path)) {
                Storage::disk('s3')->delete($path);
            }
            $ads->delete();
        }
    }

}