<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //protected $fillable=    []; //allow field
    protected $guarded=     []; //Block field

    protected $attributes=     [
        'active' => 0,
    ]; //default value

    public function getActiveAttribute($attribute){
        return $this->activeOptions()[$attribute];
    }
    

    public function scopeActive($query){
        return $query->WHERE('active',1);
    }

    public function scopeInactive($query){
        return $query->WHERE('active',2);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function activeOptions()
    {
        return [ 
            '0'=> '請選擇',
            '1'=> 'Active',
            '2'=> 'Inactive'
        ];
    }
}
