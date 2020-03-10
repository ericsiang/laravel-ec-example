<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; //需登入驗證時一定要加這行

class UserAccount extends Authenticatable
{
    protected $table = 'user_account';  //設定讀取哪個資料表
    protected $primaryKey='user_id';
    protected $guarded=[];

    public function order(){
        return $this->belongsTo(Order::class,'user_id');
    }
}
