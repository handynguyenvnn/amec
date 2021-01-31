<?php

namespace App\Repositories;

use App\Models\CardAppearanceRate;
use App\Models\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CardAppearanceRates extends Repository
{
    public $action = 'card_appearance_rates';
    /**
     * CardAppearanceRates constructor.
     */

    public function __construct()
    {
        parent::__construct(new CardAppearanceRate());
    }
    public function search(array $params)
    {
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';
        $this->query = DB::table('card_appearance_rates')
            ->join('collections', 'collections.id', 'card_appearance_rates.collection_id')
            ->join('users', 'users.id', 'card_appearance_rates.user_id')
            ->join('levels', 'levels.id', 'card_appearance_rates.level_id')
            ->select(
                'card_appearance_rates.id AS id',
                'card_appearance_rates.collection_id AS collection_id',
                'card_appearance_rates.user_id AS user_id',
                'card_appearance_rates.level_id AS level_id',
                'card_appearance_rates.occurrence_rate AS occurrence_rate',
                'card_appearance_rates.has_gacha AS has_gacha',
                'collections.name AS collection_name',
                'users.username AS username',
                'levels.name AS level_name');
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['collection_name'])) {
            $this->query->where('collections.name', 'LIKE', '%' . $params['collection_name'] . '%');
        }
        if (isset($params['level_name'])) {
            $this->query->where('levels.name', 'LIKE', '%' . $params['level_name'] . '%');
        }
        if (isset($params['username'])) {
            $this->query->where('users.username', 'LIKE', '%' . $params['username'] . '%');
        }
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }

    /**
     * Update appearance rates of card
     * @param array $params
     */
    public function updateCardRates($params) {
         $collections = Collection::all();
         foreach ($collections as $c) {
             $occurrenceRate = 0;
             switch($c->level_id) {
                 case 1:
                     $occurrenceRate = empty($params['rate-normal']) ? 0 : $params['rate-normal'];
                     break;
                 case 2:
                     $occurrenceRate = empty($params['rare']) ? 0 : $params['rare'];
                     break;
                 case 3:
                     $occurrenceRate = empty($params['intense-rare']) ? 0 : $params['intense-rare'];
                     break;
                 case 4:
                     $occurrenceRate = empty($params['super-rare']) ? 0 : $params['super-rare'];
                     break;
                 default:
                     break;

             }
             // Update or create record
             CardAppearanceRate::updateOrCreate(['collection_id' => $c->id],
                 ['collection_id' => $c->id, 'user_id' => $params['user_id'], 'level_id' => $c->level_id, 'occurrence_rate' => $occurrenceRate ]);
         }
    }

    /**
     * Get all appearance rate of card
     * @return array $rates
     */
    public function getCardRates() {
        $normalRate = CardAppearanceRate::where('level_id', 1)->first()->occurrence_rate;
        $rareRate = CardAppearanceRate::where('level_id', 2)->first()->occurrence_rate;
        $intenseRate = CardAppearanceRate::where('level_id', 3)->first()->occurrence_rate;
        $superRate = CardAppearanceRate::where('level_id', 4)->first()->occurrence_rate;
        $rates = array('normalRate' => $normalRate, 'rareRate' => $rareRate, 'intenseRate' => $intenseRate, 'superRate' => $superRate);
        return $rates;
    }
}