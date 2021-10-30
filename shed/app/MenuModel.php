<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    protected $table = 'shed_menu';
    protected $fillable = [
       'name', 'category', 'price', 'description', 'pic', 'item_status','created_at'
    ];

    
}