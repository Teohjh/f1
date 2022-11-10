<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'orders';
   protected $primaryKey = 'order_id';

   /**
    * The attributes that are mass assignable
    *
    * @var array
    */
   protected $fillable =['order_id','provider_id','total_order_amount'];
}
