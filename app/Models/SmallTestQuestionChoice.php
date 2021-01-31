<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmallTestQuestionChoice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'small_test_question_choices';

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
        'id', 'small_test_question_id', 'option_description', 'choice_no', 'language_id', 'option_value', 'image_path', 'file_id_explanation', 'file_id_setting', 'folder_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function small_test_question()
    {
        return $this->belongsTo(SmallTestQuestion::class, 'small_test_question_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
