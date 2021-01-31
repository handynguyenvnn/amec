<?php

namespace App\Http\Controllers\API;

use App\Libs\Constants\Constant;
use App\Repositories\Collections;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\User;
use App\Models\PossessionCollection;
use App\Models\Collection;
use App\Models\Type;
use App\Models\Maker;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Libs\ApiValidators\CollectionValidator;

/**
 * This class manage all function of collections
 * Class CollectionController
 * @package App\Http\Controllers\API
 */
class CollectionController extends ApiController
{
    /**
     * This function remove Possession Collections
     * @param Collections $collections
     * @param $collectionId
     * @return array
     */
    public function removePossessionCollection(Collections $collections, $collectionId)
    {
        $userId = $this->getAuthenticatedUser()->id;
        $result = $collections->destroyPossessionCollection($collectionId, $userId);
        if (!$result) {
            return $this->result(false, 'Not found this Collection');
        } else {
            return $this->result(true, 'This Collection removed success', $result, '201');
        }
    }

    /**
     * This function get all Colelcion
     * @param $lang
     * @param Collections $collections
     * @return array
     */
    public function getCollection($lang, Collections $collections)
    {
        $userId = $this->getAuthenticatedUser()->id;
        $res = $collections->getCollection($lang, $userId);
        if (!$res) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Collection download success', $res);
    }

    /**
     * This function save collection to database
     * @param Collections $collections
     * @param $lang
     * @return json
     */
    public function saveCollection( Collections $collections, $lang)
    {
        $userId = $this->getAuthenticatedUser()->id;
        $result = $collections->saveCollection( $userId, $lang);
        if (!$result) {
            return $this->result(false, 'can not post data', null, '407');
        } else {
            return $this->result(true, 'created successfully', $result, '201');
        }
    }

}
