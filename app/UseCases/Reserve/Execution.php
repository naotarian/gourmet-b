<?php

namespace App\Usecases\Reserve;
//models
use App\Models\Reserve_data;

class Execution
{
  public function __invoke($req)
  {
    $aes_key = config('app.aes_key');
    $aes_type = config('app.aes_type');
    $reserve_data = new Reserve_data;
    $reserve_data->store_id = $req['storeInfo']['id'];
    $reserve_data->seat_id = 1;
    $reserve_data->reserve_number = uniqid();
    $reserve_data->reserve_date = $req['reserveInfo']['date'];
    $reserve_data->reserve_time = $req['reserveInfo']['time'];
    $reserve_data->number_of_people = $req['reserveInfo']['numberOfPeople'];
    $reserve_data->first_name = openssl_encrypt($req['guestInfo']['firstName'], $aes_type, $aes_key);
    $reserve_data->last_name = openssl_encrypt($req['guestInfo']['lastName'], $aes_type, $aes_key);
    $reserve_data->contact_address = openssl_encrypt($req['guestInfo']['email'], $aes_type, $aes_key);
    $reserve_data->contact_tel = openssl_encrypt($req['guestInfo']['cellPhone'], $aes_type, $aes_key);
    $reserve_data->remarks = openssl_encrypt($req['guestInfo']['remarks'], $aes_type, $aes_key);
    $reserve_data->save();
    return response()->json(['msg' => '予約が完了しました。']);
  }
}
