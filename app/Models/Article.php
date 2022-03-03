<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    use HasFactory;

    function getCategory(){
        return $this->hasOne('App\Models\Category','id','categoryId');
    }


    protected $fillable = [
        'categoryId',
        'title',
        'imagePath',
        'content',
        'slug',
        'hit',
    ];
}
