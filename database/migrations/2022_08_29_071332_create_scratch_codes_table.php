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
        Schema::create('scratch_codes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("code", 8);
            $table->tinyInteger("status")->default(0);
            $table->string("type", 3);
            $table->foreignId("export_batch_id")->constrained()->default(0);
            $table->foreignId("user_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scratch_codes');
    }
};
