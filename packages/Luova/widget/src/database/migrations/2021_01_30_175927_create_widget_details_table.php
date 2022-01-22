<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidgetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::disableForeignKeyConstraints();
        Schema::create('widget_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titel');
            $table->bigInteger('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('widget_groups')->onDelete('cascade');
            $table->string('type');
            $table->longText('type_id')->nullable();
            $table->longText('type_slug')->nullable();
            $table->longText('description')->nullable();
            $table->longText('listing')->nullable();
            $table->text('images')->nullable();
            $table->text('photo')->nullable();
            $table->text('link')->nullable();
            $table->string('class')->nullable();
            $table->enum('title_visible', ['Yes', 'No'])->default('Yes');
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
        //Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('widget_details');
        //  Schema::enableForeignKeyConstraints();
    }
}
