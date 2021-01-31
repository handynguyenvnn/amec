<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'versions';

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
        'id', 'relate_version','grade_id', 'name', 'release_date_chapter', 'release_date_small_test', 'chapter_collection_id', 'big_test_id', 'file_id_version', 'folder_id_version', 'file_id_release', 'published'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }


    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'version_id');
    }

    /**
     * Events handle
     */
    protected static function boot() {
        parent::boot();

        // Before delete() method call this to clear related chapters
        static::deleting(function($versions) {
            $versions->chapters()->delete();
        });
    }
}
