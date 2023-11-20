<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_actions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('link');
            $table->string('icon');
            $table->integer('menu_id')->index()->unsigned();
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('menu_actions');
    }
}
