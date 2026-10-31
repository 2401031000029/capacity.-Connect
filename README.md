# CAPACITY CONNECT

A PHP + MySQL learning management portal prototype based on the supplied PBL-I presentation, **“A Digital Capacity Building and Learning Management Portal.”** It supports the three roles named in the presentation: Trainee, Trainer and Admin.

## Features in this prototype

- Responsive landing page and course catalogue with search.
- Registration and login with hashed passwords and role-aware navigation.
- Trainee dashboard, course enrollment, course resources, multiple-choice assessments and automatic scoring.
- Trainer workspace to create/publish courses, add external learning resources, create assessments and add assessment questions.
- Admin console to review users, activate/deactivate accounts, review platform counts and publish announcements.
- Profile and competency-interest fields, announcements, and user feedback.
- Prepared MySQL schema with foreign keys and unique enrollment constraints.

## Requirements

- PHP 8.1+ with PDO MySQL enabled
- MySQL 8+ or a compatible MariaDB version
- XAMPP / WAMP / MAMP, or another local PHP + MySQL environment

## Run locally with XAMPP

1. Copy the `CAPACITY-CONNECT` folder into XAMPP's `htdocs` folder.
2. Start **Apache** and **MySQL** from the XAMPP Control Panel.
3. Open `http://localhost/phpmyadmin` and import `schema.sql` (this creates the `capacity_connect` database and tables).
4. If your MySQL credentials differ from the defaults, edit `config.php` (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`).
5. Open `http://localhost/CAPACITY-CONNECT/setup.php` once. It creates demo accounts and four sample courses if no courses exist.
6. Open `http://localhost/CAPACITY-CONNECT/` and sign in using a demo account below.

### Demo accounts

| Role | Email | Password |
|---|---|---|
| Admin | `admin@capacityconnect.local` | `Admin@123` |
| Trainer | `trainer@capacityconnect.local` | `Trainer@123` |
| Trainee | `trainee@capacityconnect.local` | `Trainee@123` |

These credentials are for local demonstration only. Change the passwords and remove or protect `setup.php` before exposing the app to anyone else.

## Suggested demo flow

1. Log in as Trainer and open **Trainer Studio**.
2. Create a course, publish it, then add a resource URL and create an assessment.
3. Open that assessment and add multiple-choice questions with correct answers.
4. Log out and log in as Trainee; enroll in the published course, open resources and take the assessment.
5. Open the profile and add skills/competencies.
6. Log in as Admin to review users and publish an announcement.

## Notes and scope

- This is a student-project prototype, not a production-ready secure LMS. Before deployment, add rate limiting, password reset/email verification, stronger audit logging, hardened server configuration, automated tests, backups, and a reviewed authorization model.
- Resources are currently added as URLs; file upload handling is not implemented.
- Competency information is captured in user profiles, but automatic competency-to-course matching is not yet implemented.
- Certificates, live lectures/video conferencing, detailed analytics and trainer feedback workflows are listed as future extensions rather than complete features.
- All assessment questions are multiple choice and scored automatically. This prototype does not yet support essay questions or manual grading.
