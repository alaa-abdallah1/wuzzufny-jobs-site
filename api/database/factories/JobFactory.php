<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    public function definition()
    {
        $skills =
            Skill::inRandomOrder()->distinct()->take(20)->pluck('name');

        $type = $this->faker->randomElement($array = array('Full Time', 'Part Time'));

        return [
            // 'user_id' => 51,
            'user_id' => $this->faker->numberBetween($min = 1, $max = 50),
            'name' => $this->faker->jobTitle(),
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->text(500),
            'address' => $this->faker->address,
            'qualifications' => $this->faker->text(500),
            'country' => $this->faker->country,
            'experience->from' => $this->faker->numberBetween($min = 1, $max = 4),
            'experience->to' => $this->faker->numberBetween($min = 5, $max = 10),
            'skills' => $skills,
            'type' => $type,
            'companyName' => $this->faker->company,
            'aboutCompany' => $this->faker->text(500),
            'salary' => $this->faker->numberBetween($min = 100, $max = 3000),
            'logo' => 'https://wuzzufny-laravel-site.s3.us-east-2.amazonaws.com/images/logo.jpg',
            'status' => $this->faker->numberBetween($min = 0, $max = 1),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-30 days', $endDate = 'now'),
        ];
    }
}
