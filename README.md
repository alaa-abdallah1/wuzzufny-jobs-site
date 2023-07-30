# Wuzzufny
Wuzzufny is a job search platform that helps job seekers find jobs that match their qualifications and helps recruiters find suitable candidates for their companies. The platform is built using HTML, CSS, JavaScript, Vue.js, Vuetify, Vuex, Laravel, PHP, OOP, MySQL, SQL, and hosted files on AWS.

## Live Demo
[View the live demo ↗.](https://wuzzufny.onrender.com)

## Screenshots

https://github.com/alaa-abdallah1/wuzzufny-jobs-site/edit/main/README.md#screenshots-1

## Pages
- Home Page: Displays all available jobs and has two filters to filter jobs by name or country. The page also includes pagination to navigate through the pages. Clicking on a job redirects the user to the job details page where they can see more information about the job and apply or bookmark it.
- Create Job Page: Allows recruiters to create new job postings. Users must be logged in to create a new job posting.
- Profile Page: Displays user data.
- Edit Profile and Edit Job Pages: Allow users to edit their profile and job postings. Users must be logged in to edit their profile or job postings.
- My Jobs Page: Displays the jobs that the user has created. Users must be logged in to view their created jobs.
- Sign In and Sign Up Pages: Allow new users to create an account and existing users to log in. Users must be logged in to bookmark or apply to a job, create a new job posting, or edit their profile or job postings.

## Website Features
Our website offers several features to enhance your browsing experience:

### Dark and Light Modes
We understand that different users have different preferences when it comes to color schemes. That's why we offer both dark and light modes, which you can toggle between by clicking on the button located in the top right corner of the screen.

Our dark and light modes are designed to be visually appealing and easy to read. Whether you prefer a darker or lighter color scheme, you can enjoy a comfortable browsing experience on our website.

### Color Controller
In addition to our dark and light modes, we also offer a color controller that allows you to customize the main colors of our website. You can access the color controller by clicking on the settings button located next to the dark and light mode toggle.

With the color controller, you can choose from a wide range of colors and create a custom color scheme that matches your personal preferences. This feature is especially useful for users who want to personalize their browsing experience and make our website feel more like their own.

We believe that these features will make our website more accessible and user-friendly for everyone. If you have any questions or feedback about these features, please don't hesitate to contact us.

## Installation

Clone the repository

    git clone https://github.com/alaa-abdallah1/wuzzufny-jobs-site.git

Switch to the repo folder

    cd wuzzufny-jobs-site

#### Frontend Setup

     cd frontend && cp .env.example .env && npm install && npm run serve

#### Backend Setup     
     
Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Run the database Seeders (**Generate App Data**)

    php artisan db:seed

Link Storage (**let pictures work well**)

    php artisan storage:link

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

## Usage
To use Wuzzufny, follow these steps:

- Sign in or sign up for a new account.
- Navigate to the home page to find available jobs.
- Use the filter inputs to search for jobs by name or country.
- Click on a job to view more details.
- Apply to a job or bookmark it by clicking the corresponding button. Note that you must be logged in to apply or bookmark a job.
- Navigate to the create job page to create a new job posting. Note that you must be logged in to create a new job posting.
- View your profile page to see your user data.
- Edit your profile or job postings by navigating to the corresponding edit pages. Note that you must be logged in to edit your profile or job postings.
- View your created jobs on the my jobs page. Note that you must be logged in to view your created jobs.
- Use the colors controller in the settings to customize the site's main color.

## Technologies Used
Wuzzufny was built using the following technologies:

- HTML
- CSS
- JavaScript
- Vue.js
- Vuetify
- Vuex
- Laravel
- PHP
- OOP
- MySQL
- SQL
- AWS


## Screenshots

![wuzzufny onrender com_job_view_150](https://github.com/alaa-abdallah1/wuzzufny-jobs-site/assets/56931924/54997dcf-4fa0-48b6-a2c8-4285aae0ad79)

![wuzzufny onrender com_ (1)](https://github.com/alaa-abdallah1/wuzzufny-jobs-site/assets/56931924/61910c4d-38a2-4598-9781-36e5f2c2277b)

![wuzzufny onrender com_](https://github.com/alaa-abdallah1/wuzzufny-jobs-site/assets/56931924/e7194c1c-6611-412b-9b1e-e421bab1c759)

![wuzzufny onrender com_ (2)](https://github.com/alaa-abdallah1/wuzzufny-jobs-site/assets/56931924/7afa6d8c-e1ca-4f74-a365-8cd0dda16fa7)

![wuzzufny onrender com_ (5)](https://github.com/alaa-abdallah1/wuzzufny-jobs-site/assets/56931924/f15b6e32-94bc-4633-a74d-ab66183aa002)

![wuzzufny onrender com_ (4)](https://github.com/alaa-abdallah1/wuzzufny-jobs-site/assets/56931924/aba59d6a-89a4-48ed-99d9-6304f82739bc)

![wuzzufny onrender com_ (3)](https://github.com/alaa-abdallah1/wuzzufny-jobs-site/assets/56931924/dc63a029-2016-490b-a303-32670e3b2190)

## Contributing
Contributions to Wuzzufny are welcome! Please submit a pull request with your changes.

## Code owner 
This project was created by [Alaa Abdallah](https://github.com/alaa-abdallah1)
