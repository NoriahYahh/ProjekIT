<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained('activities')->onDelete('cascade'); // Foreign key untuk activity_id
            $table->string('number');
            $table->string('tm2');
            $table->string('im2');
            $table->string('ash1');
            $table->string('ash3');
            $table->string('vm2');
            $table->string('fc2');
            $table->string('ts3');
            $table->string('ts2');
            $table->string('adb');
            $table->string('arb');
            $table->string('daf');
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
        Schema::dropIfExists('coas');
    }
}
