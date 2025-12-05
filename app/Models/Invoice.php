<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
     protected $table='tbl_invoice';

    protected $fillable = ['id','invoice_id','total','date'];
   
}
