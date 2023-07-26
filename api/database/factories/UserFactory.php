<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement($array = array('male', 'female'));

        $skills =
            Skill::inRandomOrder()->distinct()->take(20)->pluck('name');


        return [
            'name' => $this->faker->name($gender),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // password
            'api_token' => Str::random(60),
            'phone' => $this->faker->phoneNumber(),
            'job' => $this->faker->JobTitle,
            'gender' => $gender,
            'country' => $this->faker->country,
            'info' => $this->faker->text(500),
            'skills' => $skills,
            'avatar' => 'https://wuzzufny-laravel-site.s3.us-east-2.amazonaws.com/images/profile-pic.jpg',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
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
