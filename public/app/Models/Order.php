<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUSES = ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'];

    protected $fillable = ['number', 'name', 'phone', 'email', 'address', 'district', 'note', 'total', 'status'];

    public function items() { return $this->hasMany(OrderItem::class); }
}
