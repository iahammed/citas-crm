<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->bothify('?????-#####'),
            'fees' => 1800,
            'note' => $this->faker->paragraph(4)
        ];
    }
}
