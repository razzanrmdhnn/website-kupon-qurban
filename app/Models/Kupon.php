<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'rt',
        'kode_unik',
        'qr_code',
        'status',
        'tanggal_penukaran',
    ];

    protected $casts = [
        'tanggal_penukaran' => 'datetime',
    ];

    /**
     * Generate unique code untuk kupon
     */
    public static function generateKodeUnik(): string
    {
        $year = date('Y');
        $lastKupon = self::whereYear('created_at', $year)->orderBy('id', 'desc')->first();

        if ($lastKupon) {
            // Extract number from last kode_unik
            $lastNumber = (int) substr($lastKupon->kode_unik, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return 'QRB-' . $year . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeTersedia($query)
    {
        return $query->where('status', 'tersedia');
    }

    public function scopeTerpakai($query)
    {
        return $query->where('status', 'terpakai');
    }

    /**
     * Format RT untuk display
     */
    public function getFormattedRtAttribute(): string
    {
        return 'RT ' . str_pad($this->rt, 2, '0', STR_PAD_LEFT);
    }
}
