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
            'code' => 'TSD'.$this->faker->unique()->randomNumber(6),
            'status' => false,
            'type' => $this->faker->countryCode(),
            'export_batch_id' => ExportPatch::factory(1)->create()->first()->id,
        ];
    }
}
