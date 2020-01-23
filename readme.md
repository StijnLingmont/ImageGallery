## About Image Gallery

The Image Gallery site is a school project for Web Development. It's a site like Pinterest or Pexels where users can create albums and upload pictures in them. You can check the live website [here](https://imagegallery.stijnlingmont.nl/).


## Install order
If you want to clone this project to your local server then you need to follow the following steps:

- Clone the project from the github
- Update composer - ``` "composer update" ```
- Install NPM packages - ``` "npm i" ```
- Run the production from Laravel mix - ``` "npm run production" ```
- Clone .env.example and rename it to .env then configure the file.
- Check if there is a 'profile-picture' and 'uploaded' folder in /storage/app/public. If there isn't then make a folder called 'profile-picture' and a folder called 'uploaded'.
- Link the storage to public - ``` "php artisan storage:link" ```
- Run artistan - ``` "php artisan serve" ```
