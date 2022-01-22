<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidgetGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widget_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titel');
            // Hasan Defaul coulmns 
            $table->string('remarks')->nullable();
            $table->bigInteger('sort_by')->nullable();
            $table->enum('is_active', ['Yes', 'No'])->default('Yes');

            $table->bigInteger('create_by')->unsigned()->nullable();
            $table->foreign('create_by')->references('id')->on('users');

            $table->bigInteger('modified_by')->unsigned()->nullable();
            $table->foreign('modified_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('widget_groups');
    }
}
