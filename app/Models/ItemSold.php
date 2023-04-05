<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSold extends Model
{
    use HasFactory;

    public $table = 'items_sold';
    public $timestamps = false;
    protected $fillable = [
        'item_id',
        'order_id',
        'price',
        'quantity'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
