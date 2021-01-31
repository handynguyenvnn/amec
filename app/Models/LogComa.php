<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogComa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'logs_coma';

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
        'id', 'control_no', 'user_id', 'end_date', 'completion_flg',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coma()
    {
        return $this->belongsTo(Coma::class, 'control_no');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs_tips()
    {
        return $this->hasMany(LogTips::class, 'lesson_log_id');
    }

    /**
     * Delete event handle
     */
    protected static function boot() {
        parent::boot();

        // Before delete() method call this to clear related contents
        static::deleting(function($chapters) {
            $chapters->logs_tips()->delete();
        });
    }
}
