<?php

namespace App\ShedModels;

use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    protected $table = 'shed_orders';
    protected $fillable = [
       'customerFname', 'customerLname', 'email', 'phone', 'address', 'order','item_id', 'quantity', 'price', 'payment_status','delivery_status','pic'
    ];


   
}