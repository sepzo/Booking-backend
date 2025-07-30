# Students Class Booking API

A basic booking system that lets users:
- View a list of available classes
- Book 1 class per day (per user rule)
- See their own upcoming bookings

## 🛠 Tech Stack
- Laravel (PHP)
- Sanctum for token-based authentication
- PostgreSQL (set in `.env`)

## 🚦 Database Structure

| Table             | Description                                      |
|-------------------|--------------------------------------------------|
| users             | (id, name, email, password)                      |
| students_classes  | (id, class_name, start_time, end_time, capacity) |
| bookings          | (id, user_id, class_id, booking_date)            |

- User can only book one class per date (unique constraint: `user_id, booking_date`).
- Each class has fixed start/end **time** (not tied to a calendar date).

## 🗝 Endpoints

| Method | Endpoint         | Description                     | Auth Required |
|--------|------------------|----------------------------------|--------------|
| POST   | /api/login       | User login (returns token)       | No           |
| POST   | /api/logout      | Revoke token/logout              | Yes          |
| GET    | /api/classes     | List available classes           | Yes          |
| POST   | /api/book        | Book a class for a date          | Yes          |
| GET    | /api/bookings    | List user's bookings             | Yes          |

## 🏁 Setup & Running

1. **Clone the repo**  
    `git clone ... && cd backend-folder`
2. **Install dependencies**  
    `composer install`
3. **Copy & edit env**  
    `cp .env.example .env` (set DB connection)
4. **Generate key**  
    `php artisan key:generate`
5. **Migrate & Seed**  
    `php artisan migrate:fresh --seed`
6. **Run**  
    `php artisan serve`

## 🔐 Demo Users

- Email: `demo1@example.com`  
  Password: `1234`
- Email: `demo2@example.com`  
  Password: `1234`
- (or more demo3, demo4 users with same password)

## 📝 Notes

- Classes are not date-specific; user picks/class is extensible for any date.
- Capacity is enforced per class per day.
- Proper error messages for duplicate bookings and class capacity.
- Users can book only 1 class for a seelcted day.
- Users may book classes on different dates, but are again limited to one booking per day.



