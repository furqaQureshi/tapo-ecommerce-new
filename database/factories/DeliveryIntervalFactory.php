<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DeliveryInterval;

class DeliveryIntervalFactory extends Factory
{
    protected $model = DeliveryInterval::class;

    public function definition()
    {
        $weeks = $this->faker->randomElement([2, 4, 6]);
        return [
            'name' => $weeks . ' weeks',
            'weeks' => $weeks,
            'is_default' => false,
        ];
    }
}
