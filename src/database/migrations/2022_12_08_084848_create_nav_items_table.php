<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_items', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('title', '255')->nullable();
            $table->tinyInteger('is_internal')->nullable();
            $table->string('url', '255')->nullable();
            $table->string('icon', '255')->nullable();
            $table->string('label', '255')->nullable();
            $table->string('tooltip', '255')->nullable();
            $table->string('menu_type', '255')->nullable();
            $table->string('module_scope', '255')->nullable();
            $table->string('sub_scope', '255')->nullable();
            $table->json('data_scope')->nullable();
            $table->integer('position')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
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
        Schema::connection('smertgenie')->dropIfExists('nav_items');
    }
}
