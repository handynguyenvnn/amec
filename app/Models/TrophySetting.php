<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrophySetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trophy_settings';

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
        'id', 'big_test_id', 'collection_id', 'correct_answer_rate', 'file_id', 'folder_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(MessageTrophySetting::class, 'trophy_setting_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function big_test()
    {
        return $this->belongsTo(BigTest::class, 'big_test_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }
}
