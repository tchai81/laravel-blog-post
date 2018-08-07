# Getting Started

1.  This project is developed using Larvel framework
2.  Development Environment: Laravel Homestead environment
    https://laravel.com/docs/5.6/homestead#introduction
3.  Create a database on your local and do a SQL dump with the attached MySQL script.
4.  Alternately, you can just run "php artisan migrate:refresh --seed" from the project folder
5.  From the project folder, update the .env file based on you dev environment
6.  In case you run into issues, try running npm install/composer install
7.  Generate new application key for laravel if necessary:-
    http://laravel-recipes.com/recipes/283/generating-a-new-application-key
8.  Generate new access tokens for laravel passport if necessary:-
    https://laravel.com/docs/5.6/passport

# Project Description

1.  There are 2 user roles in the system - Owner & user
2.  Owner - admin, User - who can leave a comment to a blog posts.
3.  Owner need to login to the system in order to create/edit posts
4.  User can only leave a comment after they have login
5.  Index page is the blog listing page, accessible to public
6.  Start by creating users with desired roles.
7.  After login, owner's dashboard page will show a blog listing associated with him/her
8.  Owner can follow the instruction on dashboard page to start creating a post
9.  User's dashboard page will just show a welcome message.

# Note

1.  User registration/creation module is scaffolded by Laravel.
2.  WYSIWYG editor does not support image upload - requires additional configuration
3.  Threaded comment is not supported.
