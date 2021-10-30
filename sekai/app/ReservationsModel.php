<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationsModel extends Model
{
    protected $table = 'sekai_reservations';
    protected $fillable = [
       'fname', 'lname', 'email', 'phone', 'time', 'date','guests','reservation_status'
    ];

    protected $attributes = [
        'lname' => '', 'reservation_status' => 'Open'
    ];
}