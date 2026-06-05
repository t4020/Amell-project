}

Amel – Service Marketplace Platform

Overview

Amel is a web-based service marketplace that connects customers with verified professionals. The platform allows customers to browse service categories, view professional profiles, request services, and leave reviews after service completion.

Professionals can publish service listings, manage incoming requests, and build their reputation through customer feedback.

The platform aims to simplify service discovery while providing a secure and transparent workflow for both customers and professionals.

⸻

Project Objectives

* Help customers find professional services quickly and easily.
* Allow professionals to advertise and manage their services.
* Provide secure role-based access to sensitive information.
* Establish trust through a customer review and rating system.
* Maintain a clear service request workflow.

⸻

Features

Authentication & User Accounts

* User Registration
* User Login & Logout
* Profile Management
* Role-Based Access Control

Customer Features

* Browse Services
* Filter Services by Category
* View Professional Profiles
* Submit Service Requests
* Track Request Status
* Leave Reviews After Completion

Professional Features

* Create Service Listings
* Edit Service Listings
* Delete Service Listings
* Manage Incoming Requests
* Accept or Reject Requests
* Mark Requests as Completed
* Maintain Professional Profile

Review System

* Customer Ratings (1–5 Stars)
* Written Reviews
* Public Review Display

⸻

Request Workflow

A service request moves through the following stages:

Pending → Accepted → Completed
Pending → Rejected

This workflow helps both customers and professionals track service progress clearly.

⸻

Technologies Used

Backend

* PHP
* Laravel Framework

Frontend

* Blade Templates
* HTML5
* CSS3
* JavaScript
* Tailwind CSS

Database

* SQLite

Build Tools

* Vite
* Composer
* NPM

Version Control

* Git
* GitHub

⸻

Database Entities

The system includes the following main entities:

* User
* Category
* WorkerProfile
* Service
* ServiceRequest
* Review

⸻

Functional Requirements

* User Authentication
* Service Discovery
* Category Filtering
* Professional Profile Viewing
* Service Listing Management
* Service Request Creation
* Request Status Management
* Customer Reviews
* User Profile Management

⸻

Non-Functional Requirements

Security

* Password Hashing
* CSRF Protection
* Role-Based Authorization

Reliability

* Foreign Key Constraints
* Data Integrity Enforcement

Usability

* Consistent User Interface
* Easy Navigation

Performance

* Pagination Support
* Efficient Data Loading

Maintainability

* Laravel MVC Architecture
* Eloquent ORM Relationships

Compatibility

* SQLite Support
* Laravel Local Development Environment

⸻

Installation

Requirements

* PHP 8+
* Composer
* Node.js
* NPM

Setup

git clone <repository-url>
cd Amel
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
npm run dev

⸻

Project Diagrams

The project documentation includes:

* Use Case Diagram
* Class Diagram

These diagrams describe system actors, workflows, and database relationships.

⸻

Testing

Run automated tests using:

php artisan test

⸻

Team Members

* Nisreen Adnan Al Hrahshe
* Mosa Abdalrazaq Saleem (Team Leader)
* Tasneem Khaled Al-Zoubi
* Ali Jamal Alkalil
* Omar Al-Qudah

⸻

Course Information

This project was developed as a Final Year Software Development Project using Laravel Framework and modern web development technologies
