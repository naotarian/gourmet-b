<?php

namespace App\Usecases\Seat;

use Illuminate\Support\Facades\Auth;
use App\Models\Seat;

class SeatRegister
{
  public function __invoke($req)
  {
    $seat = Seat::create([
      'store_id' => $req->session()->get('active_restaurant_id'),
      'seat_number' => 1,
      'name' => $req['seatName'],
      'max_number' => $req['numberOfPeople'],
      'kind' => $req['kind'],
      'priority' => $req['priority']
    ]);
    return $seat;
  }
}
