<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('user_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->BigInteger('phone_number')->nullable();
            $table->string('secret_key')->nullable();
            $table->string('login_type')->nullable();
            $table->date('dob')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('gym_name')->nullable();
            $table->string('status');            
            $table->Datetime('deleted_at')->nullable();
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
        Schema::dropIfExists('trainers');
    }
}
