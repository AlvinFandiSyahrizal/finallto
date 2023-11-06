<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalLine4 extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'Jam',
        'Tanggal',
        'PartNumber',
        'FlangeNon',
        'Quantity',
    ];
}
