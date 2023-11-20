<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMenuHeaderIdToMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->integer('menu_header_id')->unsigned()->index('IDX_MENU_HEADER_ID');
            $table->foreign('menu_header_id')->references('id')->on('menu_headers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropIndex('IDX_MENU_HEADER_ID');
            $table->dropColumn('menu_header_id');
        });
    }
}
