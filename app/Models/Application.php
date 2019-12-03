<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    const STATUS_OPEN = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_REJECTED = 3;

    protected $fillable = [
        'name', 'email', 'file',
        'job_id', 'status',
    ];

    /* Scopes */
    public function scopeOpen($query)
    {
        $query->where('status', self::STATUS_OPEN);
    }

    public function scopeAccepted($query)
    {
        $query->where('status', self::STATUS_ACCEPTED);
    }

    public function scopeRejected($query)
    {
        $query->where('status', self::STATUS_REJECTED);
    }

    /* Relationships */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /* Assetors & mutators */
    public function getIsOpenAttribute()
    {
        return $this->status == self::STATUS_OPEN;
    }

    public function getStatusNameAttribute()
    {
        if ($this->status == self::STATUS_REJECTED) {
            return 'Rejected';
        } elseif ($this->status == self::STATUS_ACCEPTED) {
            return 'Accepted';
        } else {
            return 'Open';
        }
    }
}
