<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalLine2 extends Model
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
        'Quantity',];
}
