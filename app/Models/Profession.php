<?php

namespace App\Models;

use App\Repositories\Users;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'professions';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'profession'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'profession_id');
    }
}
