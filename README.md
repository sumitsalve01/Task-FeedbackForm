# 📝 Dynamic Feedback Management System

A complete dynamic feedback platform where admins can create forms & questions, and users can register, log in, and submit feedback.

## 🚀 Features

#### 🔐 Admin Panel

- Admin login/logout
- Create & manage feedback forms
- Add dynamic questions (textarea, text, number, radio, checkbox, select, rating)
- Edit/Delete forms & questions
_ View detailed analytics with user-wise answers

#### 👤 User Side

- User registration/login
- View all available active forms
- Fill feedback forms dynamically
- Submit only once per form

#### 🛠️ Tech Stack
- Backend: Laravel
- Frontend: Blade + Bootstrap 5
- Database: MySQL

## ⚙️ Installation
Follow these steps to set up and run the project locally:

#### 1. Clone the repository
```python
git clone https://github.com/your-username/feedback-system.git
cd feedback-system
```

#### 2. Install dependencies
```python
composer install
```

#### 3. Copy .env.example to .env
```python
cp .env.example .env
```

#### 4. Update Database Credentials in .env
```python
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=feedback_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

#### 5. Run Migrations
```python
php artisan migrate
```

#### 6. Generate Application Key
```python
php artisan key:generate
```

#### 7. Start the Application
```python
php artisan serve
```

## 📌 Project Route Overview
#### 🔐 Admin Authentication
```bash
GET  /admin/login
POST /admin/login
POST /admin/logout
```
#### 📝 Feedback Form Management
```bash
GET  /feedback-forms
GET  /feedback-forms/create
POST /feedback-forms/store
GET  /feedback-forms/edit/{id}
POST /feedback-forms/update/{id}
GET  /feedback-forms/delete/{id}
```

#### ❓ Dynamic Questions
```bash
GET  /feedback-questions/{formId}
POST /feedback-questions/store/{formId}
POST /feedback-questions/update/{id}
GET  /feedback-questions/delete/{id}
```
#### 📊 Analytics
```bash
GET /admin/analytics/{formId}
```
#

#### 👤 User Authentication
```bash
GET  /register
POST /register
GET  /login
POST /login
POST /logout
```
#### 🗂 Available Forms
```bash
GET /
```
#### ✍ Fill & Submit Feedback
```bash
GET  /feedback-form/{formId}
POST /feedback-submit/{formId}
```
## License

[MIT](https://choosealicense.com/licenses/mit/)


