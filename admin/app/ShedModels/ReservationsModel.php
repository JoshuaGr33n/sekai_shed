<?php

namespace App\ShedModels;

use Illuminate\Database\Eloquent\Model;

class ReservationsModel extends Model
{
    protected $table = 'shed_reservations';
    protected $fillable = [
       'fname', 'lname', 'email', 'phone', 'time', 'date','guests','reservation_status'
    ];
}