Student Consultation System

A web-based academic consultation management system built with Laravel and MySQL.

Overview

This project was developed to simplify the organization and management of student consultations in higher education institutions. The system allows teachers to create consultations, while students can register and participate in them through a user-friendly interface.

The platform includes role-based access for administrators, teachers, and students.

Features
Student Features
User registration and authentication
Browse available consultations
Register for consultations
View consultation details
Manage personal profile
Teacher Features
Create consultations
Edit and manage consultations
View registered students
Confirm student participation
Admin Features
Manage users
Manage consultations
Administrative dashboard
Technologies Used
PHP
Laravel
MySQL
Blade Templates
Bootstrap / SCSS
JavaScript
Vite
Database Structure

Main database tables:

users
consultations
consultation_user

The system uses many-to-many relationships between users and consultations.
