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
            // $table->timestamps();
            $table->string("code", 9)->unique(); // $company code . random number
            $table->tinyInteger("status")->default(0); // used or not used 1 for used 0 for not used
            $table->string("type", 3); //like INT , SDN , KSA ....
            $table->foreignId("export_batch_id")->constrained()->default(0); // batch identify
            $table->foreignId("user_id")->constrained(); // user identify
            $table->foreignId("company_id")->constrained(); // company identify
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
