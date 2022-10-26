<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookPage extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'facebook_pages';

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable =['email','facebook_app_id','facebook_page_id','page_access_token','access_token'];
}
