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
     * Generate unique code untuk kupon (5 karakter alfanumerik random)
     */
    public static function generateKodeUnik(): string
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

        do {
            $kode = '';
            for ($i = 0; $i < 5; $i++) {
                $kode .= $characters[random_int(0, strlen($characters) - 1)];
            }
        } while (self::where('kode_unik', $kode)->exists());

        return $kode;
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
