<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrophyRank extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trophy_ranks';

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
        'id', 'trophy_rank',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function collections()
    {
        return $this->hasMany(Collection::class, 'trophy_rank_id');
    }
}
