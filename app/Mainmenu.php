<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mainmenu extends Model
{
    protected $table='mainmenu';
    protected $primaryKey='menu_id';
    protected $garded=[];

    public function submenus(){
        return $this->hasMany(Submenu::class,'menu_id');
    }
}
