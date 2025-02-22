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
        Schema::create('alternative_criterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_id')->constrained('criterias');
            $table->foreignUuid('batch_id')->constrained('batches')->cascadeOnDelete();
            $table->foreignId('alternative_id')->constrained();
            $table->float('score');
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
        Schema::dropIfExists('alternative_criterias');
    }
};
