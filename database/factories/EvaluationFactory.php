<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Evaluation;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evaluation>
 */
class EvaluationFactory extends Factory
{
    protected $model = Evaluation::class;

    public function definition()
    {
        return [
            'user_id' => random_int(1, 10), // assume que você já tem 10 usuários cadastrados
            'product_id' => random_int(1, 30), // assume que você já tem 30 produtos cadastrados
            'stars' => $this->faker->numberBetween(1, 5),
        ];
    }
}
