<?php
/**
 * Created by PhpStorm.
 * User: phongnt
 * Date: 7/3/2017
 * Time: 11:44 AM
 */

namespace App\Repositories;


use App\Models\PossessionAuthority;

class PossessionAuthorities extends Repository
{
    /**
     * PossessionAuthorities constructor.
     */
    public function __construct()
    {
        parent::__construct(new PossessionAuthority());
    }
}