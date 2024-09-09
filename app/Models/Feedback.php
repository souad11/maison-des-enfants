<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',          
        'activity_group_id', 
        'content',           
    ];

    protected $table = 'feedbacks';

    public $timestamps = true;

    // Relation avec l'enfant
    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    // Relation avec le groupe d'activités
    public function activityGroup()
    {
        return $this->belongsTo(ActivityGroup::class);
    }
}
