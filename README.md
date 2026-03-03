🚀 Work Wagon

Work Wagon is a full-stack web application that connects Shopkeepers and Workers.
It allows shops to post job vacancies and workers to find and request available opportunities.

🛠 Tech Stack
🔹 Backend

Java

Spring Boot

Spring Data JPA

MySQL

BCrypt (Password Encryption)

HttpSession (Authentication)

🔹 Frontend

React

Tailwind CSS

Fetch API

👥 User Roles
🏪 Shopkeeper

Register and login

Post shop details

Add available vacancies

View worker profiles

Send job requests to workers

Accept or reject worker requests

Update profile

👷 Worker

Register and login

Set availability status

View shop listings

Send requests to shops

Accept or reject shop requests

Update profile

🔐 Authentication

Session-based authentication using HttpSession

Passwords encrypted using BCryptPasswordEncoder

Unique email and mobile number validation

Role-based request handling

📦 Core Features
✅ Mutual Request System

Shop → Worker request

Worker → Shop request

Request status: PENDING, ACCEPTED, REJECTED

✅ Business Logic

On acceptance:

Shop vacancy count decreases

Worker availability becomes false

Duplicate requests prevented

✅ Profile Management

View profile

Update personal details

View pending and accepted requests

📁 Project Structure
work_wagon/
│
├── backend/
│   ├── Controller
│   ├── Service
│   ├── Repository
│   ├── Model
│   ├── DTO
│   └── Enum
│
└── frontend/
    ├── components
    ├── pages
    └── assets
🗄 Database

MySQL database

JPA auto schema update

Unique constraints on:

Email

Mobile number
