<?php

namespace App\Usecases\Seat;

use Illuminate\Support\Facades\Auth;
use App\Models\Seat;

class SeatUpdate
{
  public function __invoke($req)
  {
    $seat = Seat::where('id', $req['id'])->first();
    $seat['name'] = $req['seatName'];
    $seat['max_number'] = $req['numberOfPeople'];
    $seat['kind'] = $req['kind'];
    $seat['priority'] = $req['priority'];
    $seat->save();
    return $seat;
  }
}
