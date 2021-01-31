<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageSmallTest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages_small_test';

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
        'id', 'small_test_id', 'language_id', 'passing_message', 'failed_message', 'correct_message', 'incorrect_message', 'file_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function small_test()
    {
        return $this->belongsTo(SmallTest::class, 'small_test_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
