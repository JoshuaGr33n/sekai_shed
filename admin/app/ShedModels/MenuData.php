<?php

namespace App\ShedModels;

use Illuminate\Database\Eloquent\Model;

class MenuData extends Model
{
    protected $table = 'shed_menu';
    protected $fillable = [
       'name', 'category', 'price', 'description', 'pic', 'item_status'
    ];

    protected $attributes = [
        'item_status' => 'Available', 'pic' => ''
    ];
}