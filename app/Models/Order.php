<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function details()
    {
        // نفترض أن موديل تفاصيل الطلب اسمه OrderDetails
        // ونفترض أن المفتاح الخارجي في جدول تفاصيل الطلب هو 'order_id'
        return $this->hasMany(OrderDetails::class, 'order_id');
    }
}
