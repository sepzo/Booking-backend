Module: Students Classes

Build a basic system where a user can: View a list of available Students classes, Book 1 class per day, See their upcoming bookings
Database (PostgreSQL)
Use 3 tables:
users (id, name, email, password)
students_classes (id, class_name, start_time, end_time, capacity)
bookings (id, user_id, class_id, booking_date)
Laravel API
Implement these endpoints:
GET /api/classes – list available classes
POST /api/book – book a class (only 1 per day)
GET /api/bookings – list user’s bookings
Use token-based auth (Passport or Sanctum).
