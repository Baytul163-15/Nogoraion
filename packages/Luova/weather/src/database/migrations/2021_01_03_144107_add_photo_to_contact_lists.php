<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotoToContactLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_lists', function (Blueprint $table) {
            $table->string('name')->nullable()->after('email');
            $table->text('photo')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_lists', function (Blueprint $table) {
            $table->dropColumn(['name', 'photo']);
        });
    }
}
