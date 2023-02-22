<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_members', function (Blueprint $table) {
            $table->id();
            $table->string('code', 255);
            $table->string('front_background_image', 255);
            $table->float('profile_height', 255);
            $table->float('profile_width', 255);
            $table->string('profile_position', 255);
            $table->float('profile_offset_x', 255);
            $table->float('profile_offset_y', 255);
            $table->float('qrcode_height', 255);
            $table->float('qrcode_width', 255);
            $table->string('qrcode_position', 255);
            $table->float('qrcode_offset_x', 255);
            $table->float('qrcode_offset_y', 255);
            $table->float('name_height', 255);
            $table->float('name_width', 255);
            $table->string('name_position', 255);
            $table->float('name_offset_x', 255);
            $table->float('name_offset_y', 255);
            $table->float('member_code_height', 255);
            $table->float('member_code_width', 255);
            $table->string('member_code_position', 255);
            $table->float('member_code_offset_x', 255);
            $table->float('member_code_offset_y', 255);
            $table->string('back_background_image', 255);
            $table->string('created_by', 255)->nullable();
            $table->string('updated_by', 255)->nullable();
            $table->string('deleted_by', 255)->nullable();
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
        Schema::dropIfExists('card_members');
    }
}
