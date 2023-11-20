<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('set null');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
            $table->timestamps();

            $table->index('menu_id');
            $table->index('role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_role');
    }
}
