<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; //需驗證時一定要加這行


class Account extends Authenticatable   //原本是extends Model，改成extends Authenticatable，這裡要改不然會報錯
{
    protected $table = 'accounts';    
    protected $guarded=[];
}
