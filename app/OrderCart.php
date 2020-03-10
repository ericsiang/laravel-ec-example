<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCart extends Model
{
    protected $table='order_cart';
    protected $guarded=[];
    protected $primaryKey='cart_id';

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

}
