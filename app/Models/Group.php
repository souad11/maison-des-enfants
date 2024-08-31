<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'activity_id',
        // 'educator_id',
        'title',
        'min_age',
        'max_age',
    ];

    protected $table = 'groups';

    public $timestamps = false;

      /**
     * Les activités associées à ce groupe.
     */
    public function activities()
{
    return $this->belongsToMany(Activity::class, 'activity_groups', 'group_id', 'activity_id');
}


    // Méthodes
    // public function addParticipant()
    // {
    //     if ($this->available_space > 0) {
    //         $this->available_space--;
    //         $this->save();
    //     } else {
    //         throw new \Exception("Pas de place disponible");
    //     }
    // }

    // public function removeParticipant()
    // {
    //     if ($this->available_space < $this->capacity) {
    //         $this->available_space++;
    //         $this->save();
    //     }
    // }
}
