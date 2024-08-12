<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'status',
    ];

    /**
     * Get the registration associated with the payment.
     */
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
