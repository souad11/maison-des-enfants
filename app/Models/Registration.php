<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'activity_group_id',
        'status',
    ];

    /**
     * Get the child associated with the registration.
     */
    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    /**
     * Get the activity group associated with the registration.
     */
    public function activityGroup()
    {
        return $this->belongsTo(ActivityGroup::class);
    }

   
}
