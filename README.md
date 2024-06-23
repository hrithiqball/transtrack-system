<img src="https://cdn.freebiesupply.com/logos/thumbs/2x/uitm-universiti-teknologi-mara-logo.png" />

> Framework and Tools

<div style="display: flex">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
  <img src="https://img.shields.io/badge/Vue%20js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D" />
  <img src="https://img.shields.io/badge/Vite-B73BFE?style=for-the-badge&logo=vite&logoColor=FFD62E" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" />
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" />
</div>

> Languages

<div style="display: flex">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />
  <img src="https://img.shields.io/badge/TypeScript-007ACC?style=for-the-badge&logo=typescript&logoColor=white" />
  <img src="https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E" />
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" />
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" />
</div>

# Transportation System

This project is to fulfill the requirements of course CSC577 - SOFTWARE ENGINEERING: THEORIES AND PRINCIPLES. The project is about transportation management system using Laravel framework.

# Prerequisites

1. [XAMPP](https://www.apachefriends.org/index.html) - Make sure to install MySQL server as well during the installation.
2. [Composer](https://getcomposer.org/download/)
3. [NodeJs](https://nodejs.org/en)
4. [Git](https://git-scm.com/downloads) - Watch Youtube in case you are unfamiliar with the git

# Installation

1. Install PHP dependencies for backend

```bash
composer install
```

2. Install NPM dependencies for frontend

```bash
npm install
```

3. Open XAMPP and start Apache and MySQL servers.
4. Copy `.env.example` to `.env`(create new file) and update the database configuration (mysql).
5. Run migration

```bash
php artisan migrate
```

6. Generate application key

```bash
php artisan key:generate
```

7. Seed the database

```bash
php artisan db:seed
```

8. To link storage with file system

```bash
php artisan storage:link
```

9. Run the application using 2 terminals

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

# Source Control
## To update to latest version of the system

```bash
git pull
npm i
composer install
php artisan migrate
```
