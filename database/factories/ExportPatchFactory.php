<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExportPatch>
 */
class ExportPatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'batch_number' =>$this->faker->unique()->randomNumber(),
            // 'batch_size' =>$this->faker->randomDigitNotNull(),
            'company_id' => Company::factory()->count(1)->create()->first()->id,
        ];
        // $table->id();
            // $table->timestamps();
        //     $table->foreignId("user_id")->constrained();
        //     $table->integer('batch_number');
        //     $table->foreignId('company_id')->constrained();
        // });
    }
}
