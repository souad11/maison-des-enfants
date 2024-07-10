<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'educator_id',
        'title',
        'min_age',
        'max_age',
        'capacity',
        'available_space',
    ];

    protected $table = 'groups';

    public $timestamps = false;

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
