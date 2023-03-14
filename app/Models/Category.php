<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //use SoftDeletes;

    public $table = 'categories';
    protected $user_id = 'user_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $dates = ['deleted_at'];

    public function items()
    {
        return $this->hasMany('\App\Models\Item', 'category_id', 'id')->orderBy('title', 'ASC');
    }
}
