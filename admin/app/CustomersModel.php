<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomersModel extends Model
{
    protected $table = 'users';
    protected $fillable = [
       'fname', 'lname', 'email', 'phone'
    ];
}