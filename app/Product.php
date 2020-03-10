<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table='product';
    protected $guarded=[];
    protected $primaryKey='p_id';
    protected $dates = ['deleted_at'];
    
}
