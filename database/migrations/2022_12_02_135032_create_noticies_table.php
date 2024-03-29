<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->string('title', 20);
            $table->string('contents', 255);
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
        Schema::dropIfExists('noticies');
    }
}
