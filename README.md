# Online Survey System

A dynamic web-based application developed using PHP and MySQL to create, manage, conduct, and analyze online surveys. The platform provides dedicated modules for administrators and respondents, offering an organized way to collect responses and manage survey activities.

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" />
  <img src="https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" />
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" />
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" />
</p>

---

## Table of Contents

1. [Project Overview](#project-overview)
2. [Features](#features)
3. [Technology Stack](#technology-stack)
4. [Project Structure](#project-structure)
5. [How It Works](#how-it-works)
6. [Database](#database)
7. [Installation and Setup](#installation-and-setup)
8. [Screenshots](#screenshots)
9. [Future Enhancements](#future-enhancements)
10. [Author](#author)

## Project Overview

The Online Survey System is designed to simplify the process of conducting surveys digitally.

It provides two main modules:

- **Admin Module:** Allows administrators to create surveys, manage questions, control survey publishing, manage users, and analyze submitted responses.
- **Respondent Module:** Allows registered users to access published surveys, submit answers, manage their profiles, and view their survey history.

The application aims to make survey creation, response collection, and result analysis more efficient and accessible.

## Features

### 1. Admin Module

- Secure admin login.
- Admin dashboard with survey statistics.
- Create, edit, and delete surveys.
- Manage survey questions.
- Add answer options to questions.
- Publish and unpublish surveys.
- View survey details and responses.
- Manage registered users.
- Delete users.
- View survey analytics through graphical charts.
- Export survey results in CSV format.

### 2. Respondent Module

- User registration and login.
- Personalized user dashboard.
- View available published surveys.
- Participate in surveys.
- Support for radio-button and text-based questions.
- Submit survey responses.
- Prevent duplicate submissions.
- View previously submitted responses.
- Access survey response history.
- Edit user profile.
- Change account password.

### 3. Authentication and Security

- Session-based authentication.
- Role-based access control.
- Password hashing using PHP password hashing functions.
- Separate admin and respondent access.

## Technology Stack

| Technology | Purpose |
|---|---|
| HTML5 | Web page structure |
| CSS3 | Styling and layout |
| JavaScript | Interactive functionality |
| Bootstrap 5 | Responsive user interface |
| PHP | Backend development |
| MySQL | Database management |
| Chart.js | Survey analytics visualization |
| XAMPP | Local development environment |
| phpMyAdmin | Database administration |

## Project Structure

```text
Online_Survey_System/
│
├── admin/
│   ├── addOption.php
│   ├── addQuestion.php
│   ├── analytics.php
│   ├── changeSurveyStatus.php
│   ├── createSurvey.php
│   ├── dashboard.php
│   ├── deleteSurvey.php
│   ├── deleteUser.php
│   ├── editSurvey.php
│   ├── exportResults.php
│   ├── manageQuestions.php
│   ├── manageUsers.php
│   ├── viewResults.php
│   └── viewSurvey.php
│
├── authorization/
│   ├── login.php
│   ├── logout.php
│   └── register.php
│
├── includes/
│   ├── db.php
│   ├── footer.php
│   ├── header.php
│   ├── navbar.php
│   └── session.php
│
├── user/
│   ├── availableSurveys.php
│   ├── changePassword.php
│   ├── dashboard.php
│   ├── editProfile.php
│   ├── myResponses.php
│   ├── profile.php
│   ├── takeSurvey.php
│   └── viewMyResponse.php
│
├── images/
│   ├── images.jpg
│   ├── slide1.jpg
│   ├── slide2.jpg
│   └── slide3.jpg
│
├── index.php
├── test.php
└── README.md
```

## How It Works

**Step 1: User Authentication**

Users register and log in to access the application. The system identifies their roles and redirects them to the appropriate dashboard.

**Step 2: Survey Creation**

Administrators create surveys by providing titles and descriptions.

**Step 3: Question Management**

Administrators add questions and configure answer options where required.

**Step 4: Survey Publishing**

Administrators publish surveys to make them available to respondents.

**Step 5: Response Collection**

Respondents access published surveys, answer questions, and submit their responses.

**Step 6: Result Analysis**

Administrators view submitted responses, analyze survey statistics, and export results into CSV files.

## Database

The application uses MySQL as its relational database management system.

The database contains the following main entities:

| Table | Description |
|---|---|
| users | Stores user details, credentials, and roles |
| surveys | Stores survey information and publishing status |
| questions | Stores questions associated with surveys |
| options | Stores answer options for questions |
| responses | Stores submitted survey responses |
| answers | Stores individual answers submitted by respondents |

## Installation and Setup

Follow these steps to run the project locally.

### Prerequisites

- XAMPP
- PHP
- MySQL
- Web browser
- Git

### Step 1: Clone the Repository

```bash
git clone https://github.com/akshatsharma1332007-code/Online_Survey_System.git
```

### Step 2: Move the Project

Place the project folder inside the XAMPP `htdocs` directory.

### Step 3: Start XAMPP

Start Apache and MySQL from the XAMPP Control Panel.

### Step 4: Configure the Database

1. Open phpMyAdmin.
2. Create the MySQL database.
3. Import the project's SQL database file.
4. Configure the database connection in `includes/db.php`.

Note: A database SQL export was not present in the supplied project ZIP. Add your database export to the repository so others can reproduce the database structure.

### Step 5: Run the Application

Open your browser and navigate to:

```text
http://localhost/Online_Survey_System/
```

The application is now ready to run locally.

## Screenshots

Screenshots of the application will be added here.

### Home Page

![Home Page](screenshots/home-page.png)

### Admin Dashboard

![Admin Dashboard](screenshots/admin-dashboard.png)

### Survey Management

![Survey Management](screenshots/survey-management.png)

### Survey Analytics

![Survey Analytics](screenshots/analytics.png)

### Respondent Dashboard

![User Dashboard](screenshots/user-dashboard.png)

## Future Enhancements

- Export survey reports in PDF and Excel formats.
- Add more question types.
- Introduce survey deadlines and expiration dates.
- Implement email notifications.
- Improve data visualization and reporting.
- Add advanced survey filtering and search.
- Strengthen application security and validation.

## Author

**Akshat Sharma**

B.Tech – Artificial Intelligence and Machine Learning

GitHub: [akshatsharma1332007-code](https://github.com/akshatsharma1332007-code)

---

If you find this project useful, feel free to explore the repository and provide feedback.

**Developed using PHP, MySQL, Bootstrap, JavaScript, HTML, and CSS.**
