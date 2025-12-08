<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
    'booking_id',
    'metode',
    'jumlah',
    'status',
    'bukti_transfer'
];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
