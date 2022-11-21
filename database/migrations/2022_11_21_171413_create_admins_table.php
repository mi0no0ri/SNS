<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->string('name',255);
            $table->string('email',255)->unique();
            $table->string('password',255);
            $table->string('bio',400)->nullable();
            $table->string('images',255)->default('dawn.png')->nullable();
            $table->timestamps();
        });
    }
    protected $fillable = [
        'name','email','password','images',
    ];

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
