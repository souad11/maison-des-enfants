<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityGroup extends Model
{
    protected $table = 'activity_groups';

    protected $fillable = [
        'activity_id',
        'group_id',
        'educator_id', // Ajout de l'educator_id
        'capacity',        // Ajouter la capacité
        'available_space',
    ];

    public $timestamps = false;


    // Relation avec l'activité
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    // Relation avec le groupe
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    // Relation avec l'éducateur
    public function educator()
    {
        return $this->belongsTo(Educator::class);
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }

     // Relation avec les inscriptions
     public function registrations()
     {
         return $this->hasMany(Registration::class);
     }

    // Relation avec les feedbacks
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
