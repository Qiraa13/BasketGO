<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';

    protected $fillable = [
        'user_id',
        'lapangan_id',
        'jadwal_id',   // opsional, bisa null
        'status',      // Pending / Lunas / Cancel
    ];

    // ============================
    // RELATIONSHIPS
    // ============================

    // User yang melakukan booking
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Lapangan yang dibooking
    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }

    // Jadwal yang dipilih user
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    // Pembayaran terkait booking
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}
