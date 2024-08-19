<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model 

{
    use HasFactory;



    protected $fillable = [
        'user_id',
        'address',
        'postal_code',
        'phone_number'
    ];

    public $timestamps = false;

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

        /**
     * Relation avec les enfants
     */
    public function children()
    {
        return $this->hasMany(Child::class, 'tutor_id');
    }

}
