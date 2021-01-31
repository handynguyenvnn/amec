<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ads';

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
        'id', 'banner_ad', 'gacha_ad', 'content_ad'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ad_videos()
    {
        return $this->hasMany(AdVideo::class, 'ad_id');
    }
    protected static function boot() {
        parent::boot();

        // Before delete() method call this to clear related chapters
        static::deleting(function($ads) {
            $ads->ad_videos()->delete();
        });
    }
}
