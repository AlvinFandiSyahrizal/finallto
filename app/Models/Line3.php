<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line3 extends Model
{
    use HasFactory;
        /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'PartNumber',
        'Assy',
        'FlangeNon',
        'Wclutch',
    ];
}
