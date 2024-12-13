<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'number',
        'customer_name',
        'total_amount',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);  // Связь "один ко многим" с позициями заказа
    }
}
