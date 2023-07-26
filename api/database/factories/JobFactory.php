<?php

namespace Database\Factories;

use App\Models\Job;
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
            'skills' => $skillsData,
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
