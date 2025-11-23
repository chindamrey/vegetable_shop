<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomInvoice extends Model
{
    protected $table='tbl_custom_invoice';
    protected $fillable=['name','description','phone_number'];
  
      public $timestamps=false;
}
