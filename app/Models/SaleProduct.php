<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    protected $table='tbl_sale';

    protected $fillable = ['invoice_id','product_id','weight'];
   
}
