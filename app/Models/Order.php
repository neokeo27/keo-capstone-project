<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $table = 'order_info';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'session_id',
        'ip_address'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
