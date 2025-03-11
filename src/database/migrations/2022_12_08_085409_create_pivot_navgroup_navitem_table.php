<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotNavGroupNavItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_group_nav_item', function (Blueprint $table) {
            $table->id();
            $table->uuid('tenat_id')->nullable();
            $table->integer('nav_group_id')->unsigned();
            $table->integer('nav_item_id')->unsigned();
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
        Schema::dropIfExists('nav_group_nav_item');
    }
}
