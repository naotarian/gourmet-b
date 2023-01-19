<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{
    use HasFactory;
    use softDeletes;
    protected $fillable = [
        'store_id',
        'seat_number',
        'name',
        'max_number',
        'kind',
        'priority',
        'created_at',
        'updated_at',
    ];
}
