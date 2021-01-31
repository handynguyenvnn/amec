<?php
/**
 * Created by PhpStorm.
 * User: ChiNguyen
 * Date: 24/07/2017
 * Time: 17:52
 */
namespace App\Repositories;


use App\Models\PossessionCollection;
class Parts extends Repository
{
    /**
     * PossessionAuthorities constructor.
     */
    public function __construct()
    {
        parent::__construct(new PossessionCollection());
    }

    /**
     * This function save part
     *
     * @param $userId
     * @param $collectionId
     * @return PossessionCollection|bool
     */
    public function savePart( $userId, $collectionId)
    {
        $dataSave = new PossessionCollection();
        $dataSave->user_id = $userId;
        $dataSave->collection_id = $collectionId;
        return $dataSave->save();
    }

    /**
     * This function destroy part
     *
     * @param $userId
     * @param $collectionId
     * @return PossessionCollection|bool
     */
    public function destroyPart( $userId, $collectionId)
    {
        $dataDrop = PossessionCollection::where('user_id', $userId)->where('collection_id', $collectionId);
        return $dataDrop->delete();

    }

}
