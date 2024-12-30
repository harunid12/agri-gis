<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lahan extends Model
{
    use HasFactory;
    protected $table = 'lahan';
    protected $primaryKey = 'id_lahan';
    protected $fillable = [
        'koordinat_poligon', 'id_komoditas', 'id_dusun', 'alamat_lahan', 'luas_lahan'
    ];

    /**
     * Get the user that owns the Lahan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function komoditas(): BelongsTo
    {
        return $this->belongsTo(Komoditas::class, 'id_komoditas', 'id_komoditas');
    }

    /**
     * Get the user that owns the Lahan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dusun(): BelongsTo
    {
        return $this->belongsTo(Dusun::class, 'id_dusun', 'id_dusun');
    }
}
