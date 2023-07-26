<?php

namespace Database\Factories;

use App\Models\User;
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
        $skills = [
            'WordPress',
            'Microsoft',
            'Office',
            'Adobe',
            'Photoshop',
            'Adobe Photoshop',
            'Adobe Illustrator',
            'Adobe Indesign',
            'Interface Design',
            'Information Technology (IT)',
            'Graphic Design',
            'Web Design',
            'HTML',
            'CSS',
            'jQuery',
            'Bootstrap Framework',
            'Testing',
            'Animation',
            'Human Resources (HR)',
            'Recruitment',
            'Interviews',
            'Employee Relations',
            'Employment Law',
            'IT/Software Development',
            'Marketing/PR/Advertising',
            'Project/Program Management',
            'Startup',
            'magento',
            'HTML5',
            'CSS3',
            'PostgreSQL',
            'GitPlus',
            'Angular',
            'TypeScript',
            'React',
            'Computer Science',
            'Software Engineering',
            'Python',
            'Web Development',
            'Software Development',
            'Linux',
            'Diango',
            'REST',
            'Shell Scripting',
            'Software Technologies',
            'API',
        ];

        $skillsData = array();
        for ($i = 0; $i < 20; $i++) {
            if ($skills) {
                $random_keys = array_rand($skills, 20);
                $val = $skills[$random_keys[$i]];
                if (!in_array($val, $skillsData)) {
                    array_push($skillsData, $val);
                }
            }
        }

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
            'skills' => $skillsData,
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
