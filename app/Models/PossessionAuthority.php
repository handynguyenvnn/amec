<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PossessionAuthority extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'possession_authorities';

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
        'id', 'account_id', 'authority_id', 'authority_available'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function authority()
    {
        return $this->belongsTo(Authority::class, 'authority_id');
    }
}
