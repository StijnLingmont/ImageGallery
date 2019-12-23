![Logo](public/assets/img/logo.png)

## About Image Gallery

The Image Gallery site is a school project for Web Development. It's a site like Pinterest or Pexels where users can create albums and upload pictures in them. You can check the live website [here](https://imagegallery.stijnlingmont.nl/).


## Install order
If you want to clone this project to your local server then you need to follow the following steps:

- Clone the project from the github
- Update composer - ``` "composer update" ```
- Install NPM packages - ``` "npm i" ```
- Run the production from Laravel mix - ``` "npm run production" ```
- clone .env.example and rename it to .env then configure the file.
- Link the storage to public - ``` "php artisan storage:link" ```
- Run artistan - ``` "php artisan serve" ```
