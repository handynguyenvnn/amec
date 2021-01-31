<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTransmissionHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_transmission_histories';

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
        'id', 'chat_tool_id', 'sent_date', 'contents',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chat_tool()
    {
        return $this->belongsTo(ChatTool::class, 'chat_tool_id');
    }
}
