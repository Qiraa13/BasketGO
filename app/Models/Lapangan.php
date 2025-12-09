<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    protected $table = 'lapangan';

    protected $fillable = [
        'nama',
        'jenis',
        'harga_per_jam',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
