<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'amount',
        'currency',
        'status',
        'stripe_payment_id',
    ];


    protected $table = 'payments';

    public $timestamps = false;

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
