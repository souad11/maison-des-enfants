<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityGroup extends Model
{
    use HasFactory;

    protected $table = 'activity_group';

    protected $fillable = [
        'group_id',
        'activity_id',
    ];

    /**
     * Get the activity that owns the group.
     */
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * Get the group that owns the activity.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
