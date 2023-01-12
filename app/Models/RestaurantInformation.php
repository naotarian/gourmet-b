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
        'unique_code',
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
        'restaurant_tel',
        'representative_tel',
        'feature',
        'lunch_budget_id',
        'dinner_budget_id',
        'main_category_id',
        'sub_category_id',
        'is_take_out',
        'display_order',
        'created_at',
        'updated_at',
    ];
    public function lunch()
    {
        return $this->hasOne(Budget::class, 'id', 'lunch_budget_id');
    }
    public function dinner()
    {
        return $this->hasOne(Budget::class, 'id', 'dinner_budget_id');
    }
}
