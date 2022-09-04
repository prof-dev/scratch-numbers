<?php

namespace Database\Factories;

use App\Models\ExportPatch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScratchCode>
 */
class ScratchCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => 'TSD'. $this->faker->unique()->randomNumber(6),
            'status' => false,
            'type' => $this->faker->countryCode(),
            'export_batch_id' => ExportPatch::factory(1)->create()->first()->id
        ];
        // $table->id();
        //     $table->string("code", 9)->unique(); // $company code . random number
        //     $table->tinyInteger("status")->default(0); // used or not used 1 for used 0 for not used
        //     $table->string("type", 3); //like INT , SDN , KSA ....
        //     $table->foreignId("export_batch_id")->constrained()->default(0); // batch identify
        //     /
    }
}
