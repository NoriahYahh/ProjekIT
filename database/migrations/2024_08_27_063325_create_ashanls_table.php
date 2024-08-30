<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAshanlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ashanls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained('activities')->onDelete('cascade'); // Foreign key untuk activity_id
            $table->string('cal');
            $table->string('si');
            $table->string('ai');
            $table->string('fe');
            $table->string('ca');
            $table->string('mg');
            $table->string('na');
            $table->string('k2');
            $table->string('ti');
            $table->string('so');
            $table->string('mn');
            $table->string('p2');
            $table->string('un');
            $table->string('fofa');
            $table->string('slafa');
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
        Schema::dropIfExists('ashanls');
    }
}
