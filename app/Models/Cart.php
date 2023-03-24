<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    public $table = 'shopping_cart';
    protected $user_id = 'user_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'item_id', 'session_id', 'ip_address', 'quantity'
    ];


    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
