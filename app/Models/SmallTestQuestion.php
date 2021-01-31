<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmallTestQuestion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'small_test_questions';

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
        'id', 'small_test_id', 'title', 'question_format', 'score', 'file_id', 'folder_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function small_test()
    {
        return $this->belongsTo(SmallTest::class, 'small_test_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function small_test_question_choices()
    {
        return $this->hasMany(SmallTestQuestionChoice::class, 'small_test_question_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function small_test_question_problems()
    {
        return $this->hasMany(SmallTestQuestionProblem::class, 'small_test_question_id');
    }

    /**
     * Delete event handle
     */
    protected static function boot() {
        parent::boot();

        // Before delete() method call this to clear related contents
        static::deleting(function($chapters) {
            $chapters->small_test_question_choices()->delete();
            $chapters->small_test_question_problems()->delete();
        });
    }
}
