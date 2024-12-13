<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_name',
        'price',
        'quantity',
        'cost',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);  // Связь "многие к одному" с заказом
    }
}
