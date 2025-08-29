# 🎉 Event-Campus

University event management web application built with **Laravel** and **MySQL**, customized to follow Universiti Sains Malaysia (USM) event procedures.

---

## 🚀 Features
- User registration & login  
- Event creation & management  
- RSVP system for attendees  
- Admin dashboard with event statistics  

---

## 🛠️ Tech Stack
- Laravel (PHP)
- MySQL
- Tailwind CSS
- Blade Templates / Vite

---

## 📦 Installation

```bash
# Clone the repository
git clone https://github.com/izzathabib/Event-campus.git
cd Event-campus

# Install dependencies
composer install
npm install && npm run dev

# Copy environment file
cp .env.example .env

# Run migrations & seed database
php artisan migrate --seed

# Serve the application
php artisan serve
