<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_id',
        'title',
        'description',
        'type',
        'start_date',
        'end_date',
    ];

    protected $table = 'activities';

    public $timestamps = false;

    public function groups()
{
    return $this->belongsToMany(Group::class, 'activity_groups', 'activity_id', 'group_id');
}

public function price()
    {
        return $this->belongsTo(Price::class, 'price_id');
    }


}
