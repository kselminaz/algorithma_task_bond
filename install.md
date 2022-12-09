1. Clone GitHub repo for this project locally

   git clone https://github.com/kselminaz/algorithma_task_bond.git
2. Remember to type cd projectName to move your terminal working location to the project file
3. Install Composer Dependencies

   composer install
4. Create a copy of your .env file

   cp .env.example .env
5. Generate an app encryption key

   php artisan key:generate
6. Create an empty database for the app with the name "task_bond" in mysql
7. Migrate the database

   php artisan migrate
8. Seed the database

   php artisan db:seed







