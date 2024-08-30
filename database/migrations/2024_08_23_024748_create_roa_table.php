<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_o_a_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained('activities')->onDelete('cascade'); // Foreign key untuk activity_id
            $table->string('tm');
            $table->string('im');
            $table->string('ash');
            $table->string('ash2');
            $table->string('vm');
            $table->string('fc');
            $table->string('ts');
            $table->string('Adb');
            $table->string('Arb');
            $table->string('Daf');
            $table->string('Analisis_Standar');
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
        Schema::dropIfExists('r_o_a_s');
    }
}
