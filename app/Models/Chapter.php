<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chapters';

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
        'id', 'version_id', 'control_no', 'collection_id', 'chapter_no', 'folder_id', 'file_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function version()
    {
        return $this->belongsTo(Version::class, 'version_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chapter_names()
    {
        return $this->hasMany(ChapterName::class, 'chapter_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'control_no');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function small_tests()
    {
        return $this->hasMany(SmallTest::class, 'chapter_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comas()
    {
        return $this->hasMany(Coma::class, 'chapter_id');
    }

    /**
     * Delete event handle
     */
    protected static function boot() {
        parent::boot();

        // Before delete() method call this to clear related contents
        static::deleting(function($chapters) {
            $chapters->chapter_names()->delete();
            $chapters->bookmarks()->delete();
            $chapters->small_tests()->delete();
            $chapters->comas()->delete();
        });
    }
}
