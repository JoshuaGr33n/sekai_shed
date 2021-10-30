<?php

namespace App\SekaiModels;

use Illuminate\Database\Eloquent\Model;

class MenuData extends Model
{
    protected $table = 'sekai_menu';
    protected $fillable = [
       'name', 'category', 'price', 'description', 'pic', 'item_status', 'specials'
    ];

    protected $attributes = [
        'item_status' => 'Available', 'pic' => ''
    ];


    // public function setCategoryAttribute($value)
    // {
    //     $this->attributes['category'] = json_encode($value);
    // }

    // public function getCategoryAttribute($value)
    // {
    //     return $this->attributes['category'] = json_decode($value);
    // }
}