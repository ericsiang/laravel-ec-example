<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $table='submenu';
    protected $primaryKey='sub_id';
    protected $garded=[];


    public function mainmenu(){
        return $this->belongsTo(Mainmenu::class,'menu_id');
    }
}
