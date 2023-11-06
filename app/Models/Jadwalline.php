<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwalline extends Model
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
