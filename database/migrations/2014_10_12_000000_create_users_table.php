<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number', 16)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('birthplace', 100)->nullable();
            $table->string('religion', 20)->nullable();
            $table->string('education', 100)->nullable();
            $table->text('address')->nullable();
            $table->string('job', 150)->nullable();
            $table->string('skill')->nullable();
            $table->integer('serial_number')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('ktp_image')->nullable();
            $table->string('qrcode_image', 200)->nullable();
            $table->integer('login_tried')->nullable();
            $table->dateTime('login_expired_in')->nullable();
            $table->string('login_expired_in_seconds')->nullable();
            $table->boolean('is_logged_in')->default(false);
            $table->boolean('status')->default(true);
            $table->boolean('is_blocked')->default(false);
            $table->string('ip_address', 50)->nullable();
            $table->integer('forgot_password_tried')->nullable()->default(0);
            $table->string('forgot_password_code')->nullable();
            $table->string('forgot_password_token')->nullable();
            $table->dateTime('forgot_password_expired_at')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
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
        Schema::dropIfExists('users');
    }
}
