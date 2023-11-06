<?php

namespace App\Models;

use Carbon\Carbon as CarbonCarbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Input extends Model
{
    use HasFactory;
        /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'Tanggal',
        'PartNumber',
        'FlangeNon',
        'Quantity',
    ];



}
