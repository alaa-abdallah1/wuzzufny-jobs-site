<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsTableSeeder extends Seeder
{
    public $skills = [
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
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->skills as $skill) {
            DB::table('skills')->insert([
                'name' => $skill,
            ]);
        }

    }
}