<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = [];


    public function invoices()
    {
        return $this->hasOne(Invoice::class, 'order_no', 'order_no');
    }
}
