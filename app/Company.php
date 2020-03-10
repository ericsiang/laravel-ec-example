<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded=[];//Block field

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
