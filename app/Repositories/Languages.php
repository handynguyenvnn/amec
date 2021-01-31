<?php

namespace App\Repositories;

use App\Models\Language;
use App\Models\Area;
use App\Models\Profession;
use App\Models\User;

class Languages extends Repository
{
    /**
     * Languages constructor.
     */
    public function __construct()
    {
        parent::__construct(new Language());
    }

    /**
     * get All language in table languages
     * @return array (id, code, name)
     */
    public function getLang()
    {
        return $this->query->select('id', 'lang_code as code', 'lang as name')->get();
    }
    public function postLang( $languageId, $userId){
        $user = User::find($userId);
        $user->language_id = $languageId;
        $user->save();
        return $user;
    }

    public function getAll()
    {
        return $this->query->get();
    }
}