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
        Schema::create('reset_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("user_name");
            $table->string("code");
            $table->string("consumed_by");
            $table->foreignId("user_id")->constrained();
            $table->foreignId("company_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reset_histories');
    }
};
