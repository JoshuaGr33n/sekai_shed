<?php

namespace App\SekaiModels;

use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    protected $table = 'sekai_orders';
    protected $fillable = [
       'customerFname', 'customerLname', 'email', 'phone', 'address', 'order','item_id', 'quantity', 'price', 'payment_status','delivery_status','pic'
    ];


   
}