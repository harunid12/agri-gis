<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dusun extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_dusun';
    protected $table = 'dusun';
    protected $fillable = ['nama_dusun'];
}
