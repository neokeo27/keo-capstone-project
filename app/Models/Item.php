<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    //use SoftDeletes;
    use HasFactory;

    public $table = 'items';
    protected $user_id = 'user_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->hasOne('\App\Models\Category', 'id', 'category_id')->orderBy('name', 'ASC');
    }
}
