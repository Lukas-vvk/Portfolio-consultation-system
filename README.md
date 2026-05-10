# 🎓 Student Consultation System

A web-based academic consultation management platform built using Laravel and MySQL.

---

## 📖 Overview

This project was developed to simplify the management of academic consultations in higher education institutions.

The system provides separate access levels for students, teachers, and administrators.

- Students can register for consultations
- Teachers can manage consultation schedules
- Administrators can manage users and the system

---

## ✨ Features

### 👨‍🎓 Student Features
- User registration and authentication
- Browse available consultations
- Register for consultations
- View consultation information
- Edit personal profile

### 👨‍🏫 Teacher Features
- Create consultations
- Edit consultation details
- View registered students
- Confirm participation requests

### 👨‍💼 Admin Features
- User management
- Consultation management
- Administrative dashboard

---

## 🛠 Technologies Used

| Technology | Purpose |
|------------|----------|
| PHP | Backend development |
| Laravel | Web framework |
| MySQL | Database |
| Blade | Templating engine |
| SCSS | Styling |
| JavaScript | Frontend interactions |
| Vite | Asset bundling |

---

## 🗄 Database Structure

Main tables used in the system:

```sql
users
consultations
consultation_user

The system uses many-to-many relationships between students and consultations.
