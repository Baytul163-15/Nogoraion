<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitpolicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitpolices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('menu_id');
            $table->string('designation');
            $table->string('bit_name')->nullable();
            $table->text('address')->nullable();
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('remarks')->nullable();
            $table->string('name')->nullable();
            $table->text('photo')->nullable();
            $table->text('map')->nullable();
            $table->text('map_photo')->nullable();
            $table->enum('is_active', ['Yes', 'No', 'Del'])->default('Yes');
            $table->date('create_date');
            $table->integer('sort_by')->nullable();
            $table->integer('create_by')->nullable();
            $table->integer('last_modified')->nullable();
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
        Schema::dropIfExists('bitpolices');
    }
}
