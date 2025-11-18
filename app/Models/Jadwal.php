<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'lapangan_id',
    ];

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}
