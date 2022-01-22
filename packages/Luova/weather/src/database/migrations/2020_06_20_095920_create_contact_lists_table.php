<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_lists', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('menu_id');
            $table->string('designation');
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('contact_lists');
    }
}
