<?php

namespace App\SekaiModels;

use Illuminate\Database\Eloquent\Model;

class CategoriesModel extends Model {

    protected $table = 'sekai_categories';
    protected $fillable = [
        'category'
    ];
}