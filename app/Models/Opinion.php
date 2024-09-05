<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;

    protected $fillable = ['tutor_id', 'texte', 'is_approved'];

    protected $table = 'opinions';

    public $timestamps = true;

    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id');
    }
}
