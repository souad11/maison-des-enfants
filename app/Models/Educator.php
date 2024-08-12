<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educator extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'photo',
    ];

    protected $table = 'educators';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    


}
