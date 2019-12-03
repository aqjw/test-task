<?php

namespace App\Models;

use App\Models\Application;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    const STATUS_OPEN = 1;
    const STATUS_CLOSED = 2;

    protected $table = 'job_vacations';

    protected $fillable = [
        'title', 'description',
        'status',
    ];

    protected $appends = [
        'description_short'
    ];

    /* Scopes */
    public function scopeOpen($query)
    {
        $query->where('status', self::STATUS_OPEN);
    }

    public function scopeClosed($query)
    {
        $query->where('status', self::STATUS_CLOSED);
    }

    /* Relationships */
    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }

    /* Assetors & mutators */
    public function getIsOpenAttribute()
    {
        return $this->status == self::STATUS_OPEN;
    }

    public function getDescriptionShortAttribute()
    {
        return str_limit($this->description, 100);
    }

    public function getStatusNameAttribute()
    {
        // TODO: 
        return $this->status == self::STATUS_OPEN ? 'Open' : 'Closed';
    }
}
