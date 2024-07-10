<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $table = 'children';

    protected $fillable = [
        'tutor_id',
        'group_id',
        'firstname',
        'lastname',
        'birthday',
        'gender',
    ];

    public $timestamps = false;


    // Définissez ici les relations, si nécessaire
    // Exemple : Un enfant appartient à un parent
    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'parent_id');
    }


}
