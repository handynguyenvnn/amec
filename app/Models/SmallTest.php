<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmallTest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'small_tests';

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
        'id', 'chapter_id', 'num_issues', 'pass_score_rate', 'question_format', 'option_display_format', 'control_no', 'file_id', 'folder_id',
    ];
	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'pass_score_rate'   => 'int',
		'question_format'   => 'int',
	];
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
    public function small_test_questions()
    {
        return $this->hasMany(SmallTestQuestion::class, 'small_test_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages_small_test()
    {
        return $this->hasMany(MessageSmallTest::class, 'small_test_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs_small_test()
    {
        return $this->hasMany(LogSmallTest::class, 'control_no');
    }

    /**
     * Delete event handle
     */
    protected static function boot() {
        parent::boot();

        // Before delete() method call this to clear related contents
        static::deleting(function($chapters) {
            $chapters->small_test_questions()->delete();
            $chapters->messages_small_test()->delete();
            $chapters->logs_small_test()->delete();
        });
    }
}
