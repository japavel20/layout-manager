<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotNavItemRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_item_role', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedInteger('role_id')->nullable();
            $table->foreignUuid('nav_group_id')->nullable();
            $table->foreignUuid('nav_item_id')->nullable();
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
        Schema::dropIfExists('nav_item_role');
    }
}
