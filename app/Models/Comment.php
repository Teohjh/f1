<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'comments';
   protected $primaryKey = 'comment_id';

   /**
    * The attributes that are mass assignable
    *
    * @var array
    */
   protected $fillable =['comment_id','live_stream_id','provider_id','name','comment','comment_date_time'];
}
