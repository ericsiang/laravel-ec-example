<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='order_list';
    protected $guarded=[];
    protected $primaryKey='order_id';

    public function ordercarts(){
        return $this->hasMany(OrderCart::class,'order_id');
    }

    public function orderuser(){
        return $this->hasOne(user_account::class,'user_id');
    }
}
