<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesInformation extends Model
{
    protected $table = 'sales_informations';
    use softDeletes;
    use HasFactory;
    protected $fillable = [
        'store_id',
        'start_business',
        'end_business',
        'regular_holiday',
        'late_reserve',
        'created_at',
        'updated_at',
    ];
}
