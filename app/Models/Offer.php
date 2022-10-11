<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'id',
        'model_id',
        'generation',
        'generation_id',
        'year',
        'run',
        'color_id',
        'body_type_id',
        'engine_type',
        'transmission',
        'gear_type',
    ];
}
