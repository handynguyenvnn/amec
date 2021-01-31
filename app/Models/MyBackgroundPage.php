<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyBackgroundPage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'my_background_pages';

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
        'id', 'user_id', 'grade_id', 'image_path'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
