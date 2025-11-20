<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class crud_product extends Model
{
    protected $table='tbl_product';
    protected $fillable = ['p_name','p_price'];
    public $timestamps=false;
}
