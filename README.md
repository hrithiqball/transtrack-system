<img src="https://cdn.freebiesupply.com/logos/thumbs/2x/uitm-universiti-teknologi-mara-logo.png" />

> Framework and Tools

<img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
<img src="https://img.shields.io/badge/Vue%20js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D" />
<img src="https://img.shields.io/badge/Vite-B73BFE?style=for-the-badge&logo=vite&logoColor=FFD62E" />
<img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" />
<img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" />

> Languages

<img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />
<img src="https://img.shields.io/badge/TypeScript-007ACC?style=for-the-badge&logo=typescript&logoColor=white" />
<img src="https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E" />
<img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" />
<img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" />

# Transportation System

This project is to fulfill the requirements of course CSC577 - SOFTWARE ENGINEERING: THEORIES AND PRINCIPLES. The project is about transportation management system using Laravel framework.

### Requirements

- [x] Login/Logout

Allow user to login and logout from the web application using session management.

- [x] Registration

Allow new user to register to the web system.

- [ ] Information management: Create / Read / Update / Delete

Allow user to manage information from a database such as to create, read, update and delete information from the database.

- [ ] Dashboard

To provide user an overview of the process or information by different data representations.

### Prerequisites

1. [XAMPP](https://www.apachefriends.org/index.html). Make sure to install MySQL server as well during the installation.
2. [Composer](https://getcomposer.org/download/)
3. [NodeJs](https://nodejs.org/en)

### Installation

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

7. Run the application using 2 terminals

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```


## To update to latest version of the system

```bash
git pull
```

```bash
npm i
```

```bash
composer install
```

```bash
php artisan migrate
```