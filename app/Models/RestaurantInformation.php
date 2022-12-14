<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantInformation extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = 'restaurant_informations';
    protected $fillable = [
        'admin_user_id',
        'restaurant_name',
        'restaurant_email',
        'notification_email',
        'post_number',
        'address',
        'address_after',
        'display_order',
        'is_reserve',
        'is_display',
        'representative_name',
        'representative_tel',
        'feature',
        'lunch_budget_id',
        'dinner_budget_id',
        'main_category_id',
        'sub_category_id',
        'created_at',
        'updated_at',
    ];
}
