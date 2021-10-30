<?php

namespace App\ShedModels;

use Illuminate\Database\Eloquent\Model;

class CategoriesModel extends Model {

    protected $table = 'shed_categories';
    protected $fillable = [
        'category'
    ];
}