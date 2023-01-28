<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve_data extends Model
{
    use HasFactory;
    public function getFirstNameAttribute($value)
    {
        $aes_key = config('app.aes_key');
        $aes_type = config('app.aes_type');
        return empty($value) ? null : openssl_decrypt($value, $aes_type, $aes_key);
    }
    public function getLastNameAttribute($value)
    {
        $aes_key = config('app.aes_key');
        $aes_type = config('app.aes_type');
        return empty($value) ? null : openssl_decrypt($value, $aes_type, $aes_key);
    }
    public function getContactAddressAttribute($value)
    {
        $aes_key = config('app.aes_key');
        $aes_type = config('app.aes_type');
        return empty($value) ? null : openssl_decrypt($value, $aes_type, $aes_key);
    }
    public function getContactTelAttribute($value)
    {
        $aes_key = config('app.aes_key');
        $aes_type = config('app.aes_type');
        return empty($value) ? null : openssl_decrypt($value, $aes_type, $aes_key);
    }
    public function getRemarksAttribute($value)
    {
        $aes_key = config('app.aes_key');
        $aes_type = config('app.aes_type');
        return empty($value) ? null : openssl_decrypt($value, $aes_type, $aes_key);
    }
    // public function getFirstNameKanaAttribute($value)
    // {
    //     $aes_key = config('app.aes_key');
    //     $aes_type = config('app.aes_type');
    //     return empty($value) ? null : openssl_decrypt($value, $aes_type, $aes_key);
    // }
    // public function getFirstNameKanaAttribute($value)
    // {
    //     $aes_key = config('app.aes_key');
    //     $aes_type = config('app.aes_type');
    //     return empty($value) ? null : openssl_decrypt($value, $aes_type, $aes_key);
    // }
}
