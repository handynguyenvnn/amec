<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BigTest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'big_tests';

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
        'id', 'grade_id', 'pass_score_rate', 'control_no', 'collection_id', 'file_id'
    ];
	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'pass_score_rate' => 'int',
	];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(MessageBigTest::class, 'big_test_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(LogBigTest::class, 'control_no');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trophy_settings()
    {
        return $this->hasMany(TrophySetting::class, 'big_test_id');
    }
}
