<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_surveyors_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyorsTable extends Migration
{
    public function up()
    {
        Schema::create('surveyors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surveyors');
    }
}
