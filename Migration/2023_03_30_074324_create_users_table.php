<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLTestTaskUsers extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('l_test_task_users', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->string('email');
            $table->boolean('admin');
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('l_test_task_users');
    }
};
