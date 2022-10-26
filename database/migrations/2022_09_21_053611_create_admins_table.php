<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('admin_name')->unique();
            $table->string('admin_email');
            $table->timestamp('admin_email_verified_at')->nullable();
            $table->string('admin_password');
            $table->string('facebook_account_id')->nullable();
            $table->string('facebook_page_id')->nullable();
            $table->text('facebook_page_access_token')->nullable();
            $table->text('token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
