<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidProduct extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'bid_products';
   protected $primaryKey = 'bid_id';

   /**
    * The attributes that are mass assignable
    *
    * @var array
    */
   protected $fillable =['bid_id','live_stream_id','product_code','product_name','product_description',
   'product_image','product_price','product_sales_quantity'];
}
