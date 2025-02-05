<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        Schema::create('user_tracking', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->references('id')->on('users');
            $table->enum('status', ['A', 'I'])->comment('A: Active, I: Inactive')->nullable();
            $table->char('status_conection', 1)->comment('1: Connected, 0: Disconected')->nullable();
            $table->dateTime('last_conection')->nullable();
        });
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tracking');
    }
};
