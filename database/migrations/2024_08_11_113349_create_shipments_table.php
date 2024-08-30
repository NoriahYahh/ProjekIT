
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id(); // unsignedBigInteger secara otomatis
            $table->foreignId('activity_id')->constrained('activities')->onDelete('cascade');
            $table->string('gar');
            $table->string('type');
            $table->string('mv')->nullable();
            $table->string('bg')->nullable();
            $table->string('sp');
            $table->string('fv');
            $table->string('fd');
            $table->string('bf');
            $table->string('rc');
            $table->string('ss');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->enum('cargo', ['Block 2', 'Block 3', 'Block 4']);
            $table->string('company_id');
            $table->string('dt');
            $table->string('tg');
            $table->string('sv');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
