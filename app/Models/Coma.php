<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coma extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comas';

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
        'id', 'chapter_id', 'frame_name', 'frame_no', 'coma_category_id', 'file_id', 'folder_id', 'control_no',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ComaCategory::class, 'coma_category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coma_languages()
    {
        return $this->hasMany(ComaLanguage::class, 'coma_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs_coma()
    {
        return $this->hasMany(LogComa::class, 'control_no');
    }

    /**
     * Delete event handle
     */
    protected static function boot() {
        parent::boot();

        // Before delete() method call this to clear related contents
        static::deleting(function($chapters) {
            $chapters->coma_languages()->delete();
            $chapters->logs_coma()->delete();
        });
    }
}
