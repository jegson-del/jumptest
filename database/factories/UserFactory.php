<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;



class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *$name
     * @return array
     */
    public function definition()
    {

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail(),
            'Avatar' => $this->faker->url(),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
