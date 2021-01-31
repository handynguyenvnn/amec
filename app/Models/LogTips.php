<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogTips extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'logs_tips';

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
        'id', 'tips_id', 'lesson_log_id', 'small_test_log_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tips()
    {
        return $this->belongsTo(Tips::class, 'tips_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function log_lesson()
    {
        return $this->belongsTo(LogLesson::class, 'lesson_log_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function log_small_test()
    {
        return $this->belongsTo(LogSmallTest::class, 'small_test_log_id');
    }
}
