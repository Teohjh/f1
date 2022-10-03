<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    use Notifiable;

        protected $guard = 'admin';

        protected $fillable = [
            'admin_name', 'admin_email', 'admin_password',
        ];

        protected $hidden = [
            'admin_password', 'remember_token',
        ];

        public function getAuthPassword()
        {
            return $this->admin_password;
        }
}
