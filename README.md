# Laravel E-commerce Shop with Order Email Notifications

A full-stack e-commerce web app built with **Laravel** for a small local shop in Bangladesh. Customers can browse products and place Cash on Delivery orders without creating an account. When an order is placed, the **shop owner is notified by email instantly** and the customer receives a confirmation email.

## Features

**Customer side**
- Product listing with category filter and search
- Product details page with stock status
- Session-based shopping cart (add, update, remove)
- Guest checkout with validation (including Bangladeshi phone number format)
- Order confirmation page and confirmation email

**Order email notifications**
- Owner receives an email with order number, customer details, items and total
- Customer receives an order confirmation email
- Emails are sent with Laravel Mailables and Blade templates
- If email sending fails, the order is still saved and the error is logged

**Admin panel**
- Secure admin login (admin-only middleware)
- Dashboard stats: total orders, pending orders, total sales
- Order list with status filter, order details, status updates (Pending, Confirmed, Shipped, Delivered, Cancelled)
- Product management: add, edit, delete, image upload

**Engineering details**
- Database transaction for order creation, with row locking to prevent overselling
- Stock is reduced automatically when an order is placed
- Form validation with custom messages
- Double-submit protection on forms
- Secrets kept in `.env` (never committed)

## Tech Stack
- PHP 8.2+, Laravel 11
- MySQL (SQLite works for local testing)
- Blade templates, Tailwind CSS
- SMTP email (Mailtrap for testing, Gmail SMTP / Brevo / Resend for production)


## Getting Started

1. Clone the repository
   ```bash
   git clone https://github.com/samanthahere/laravel-ecommerce-shop.git
   cd laravel-ecommerce-shop
   ```
2. Install dependencies
   ```bash
   composer install
   ```
3. Create your environment file and app key
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Open `.env` and set your database and mail settings. Add these shop settings:
   ```
   SHOP_NAME="Local Shop"
   ADMIN_EMAIL=owner@example.com
   ADMIN_LOGIN_EMAIL=admin@example.com
   ADMIN_PASSWORD=choose-a-strong-password
   ```
   `ADMIN_EMAIL` is where new order notifications are sent.
5. Create the database tables and sample data
   ```bash
   php artisan migrate --seed
   php artisan storage:link
   ```
6. Start the server
   ```bash
   php artisan serve
   ```
   - Shop: http://127.0.0.1:8000
   - Admin: http://127.0.0.1:8000/admin/login

## Project Structure (main parts)
- `app/Http/Controllers` - shop, cart, checkout and admin controllers
- `app/Mail` - `OrderPlacedAdmin` and `OrderConfirmation` mailables
- `app/Models` - Product, Category, Order, OrderItem
- `app/Support/Cart.php` - session cart helper
- `resources/views` - Blade views and email templates
- `database/migrations` and `database/seeders`

## Possible Improvements
- Category management in the admin panel
- Online payment (bKash / Nagad)
- Order status update emails to customers
- Queued emails for faster checkout

## License
Open source for learning and portfolio purposes.