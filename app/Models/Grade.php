<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'grades';

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
        'id', 'project_id', 'grade_no', 'content_type', 'folder_id', 'file_id'
    ];

    /**
     * Many grades belong to one project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function my_background_pages()
    {
        return $this->hasMany(MyBackgroundPage::class, 'grade_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function big_tests()
    {
        return $this->hasMany(BigTest::class, 'grade_id');
    }

    public function messages_big_test()
    {
        return $this->hasMany(MessageBigTest::class, 'grade_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grade_names()
    {
        return $this->hasMany(GradeName::class, 'grade_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function collections()
    {
        return $this->hasMany(Collection::class, 'grade_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function versions()
    {
        return $this->hasMany(Version::class, 'grade_id');
    }
    protected static function boot() {
        parent::boot();

        // Before delete() method call this to clear related chapters
        static::deleting(function($grades) {
            $grades->grade_names()->delete();
            $grades->my_background_pages()->delete();
            $grades->versions()->delete();
            $grades->big_tests()->delete();
            $grades->messages_big_test()->delete();

        });
    }
}
