# 🎬 Real Cinema Backend

This is the backend for a cinema ticket booking system that supports both **online** and **offline (receptionist)** bookings. The system includes features for **users**, **admins**, and **receptionists** to manage movies, bookings, food orders, and feedback.

---

## 📌 Features

### 👤 User
- Book tickets for available movies and select specific seats.
- View trailers, movie descriptions, and actor/director information.
- Order food and drinks alongside ticket booking.
- Submit feedback about the cinema experience.

### 💼 Admin
- Add new movies with the following details:
  - Movie name
  - Description
  - Start and end date
  - Poster image
  - Trailer video link
  - Type (e.g. Action, Comedy, Drama)
  - Actors and director
- Update or delete existing movies.
- View and manage all bookings.
- Delete or update any ticket booking.
- Manage and view user feedback.

### 🧾 Receptionist
- Book tickets offline at the cinema desk.
- Modify or delete ticket information for walk-in customers.
- Assign seats in real time based on availability.

---

## 🗃️ Database Requirements

This project uses a **relational database** (SQL). You must have a database installed and set up before running the backend.

Tables include:

- `users` (ID, name, email, password, roleId)
- `movies` (ID, title, description, poster, trailer, actors, director, type, start_date, end_date)
- `seats` (ID, seat_number, row, hall_id, is_booked, movie_id)
- `bookings` (ID, user_id, seat_id, movie_id, booking_time, food_order_id)
- `food_orders` (ID, food_items, total_price)
- `feedback` (ID, user_id, message, created_at)

---

## 🚀 Technologies Used

- php native
- mysql
