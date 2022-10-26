<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lives';

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable =['live_stream_id','embed_html','status','stream_url','secure_stream_url'];
}
