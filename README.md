# Laravel E-commerce Shop with Instant Order Email Notifications

A full-stack e-commerce web app built with **Laravel** for a small local shop in Bangladesh. Customers browse products and place **Cash on Delivery** orders without creating an account. When an order is placed, the **shop owner is notified by email instantly** and the customer receives a confirmation email.

**Live demo:** https://laravel-ecommerce-shop.onrender.com
**Admin panel:** https://laravel-ecommerce-shop.onrender.com/admin/login

> The demo runs on a free hosting plan, so the first visit after a period of inactivity can take up to a minute to load.
> In the demo, order emails are sent through Resend's test sender, so confirmation emails reach only the shop owner's account. With a verified domain they go to any customer address.


## Features

**Customer side**
- Product listing with category filter and search
- Product details page with stock status
- Session-based shopping cart (add, update, remove)
- Guest checkout with validation, including Bangladeshi phone number format
- Order confirmation page and confirmation email
- Responsive, mobile-first design with Tailwind CSS

**Order email notifications**
- The shop owner receives an email with the order number, customer details, items and total
- The customer receives an order confirmation email
- Built with Laravel Mailables and Blade email templates
- If email sending fails, the order is still saved and the error is logged

**Admin panel**
- Secure admin login protected by admin-only middleware
- Dashboard stats: total orders, pending orders, total sales
- Order list with status filter, order details, and status updates (Pending, Confirmed, Shipped, Delivered, Cancelled)
- Product management: add, edit, delete, image upload

**Engineering details**
- Order creation runs in a database transaction with row locking to prevent overselling
- Stock is reduced automatically when an order is placed
- Server-side validation with custom messages
- Double-submit protection on checkout and product forms
- Secrets are kept in environment variables and never committed

## Tech Stack
- PHP 8.2+, Laravel 11
- MySQL locally, PostgreSQL (Neon) in production
- Blade templates, Tailwind CSS
- Email: SMTP (Mailtrap for testing) locally, Resend API in production
- Deployment: Docker (Apache + PHP) on Render

## Getting Started (local)

1. Clone the repository
   ```bash
   git clone https://github.com/samanthahere/laravel-ecommerce-shop.git
   cd laravel-ecommerce-shop
   ```
2. Install dependencies
   ```bash
   composer install
   ```
3. Create the environment file and app key
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Open `.env`, set your database and mail settings, and add:
   ```
   SHOP_NAME="Local Shop"
   ADMIN_EMAIL=owner@example.com
   ADMIN_LOGIN_EMAIL=admin@example.com
   ADMIN_PASSWORD=choose-a-strong-password
   ```
   `ADMIN_EMAIL` is where new order notifications are sent.
5. Create the tables and sample data
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

## Deployment
The app ships with a `Dockerfile` and `start.sh` for container hosting. On Render, create a Docker web service from this repository and set the environment variables below. The start script runs migrations and seeds the database on boot.

| Variable | Purpose |
|---|---|
| `APP_KEY`, `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL` | Laravel basics |
| `DB_CONNECTION=pgsql`, `DB_URL` | Database connection |
| `MAIL_MAILER=resend`, `RESEND_API_KEY`, `MAIL_FROM_ADDRESS` | Email sending |
| `SHOP_NAME`, `ADMIN_EMAIL`, `ADMIN_LOGIN_EMAIL`, `ADMIN_PASSWORD` | Shop and admin settings |

## Project Structure
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
- Cloud image storage for product photos
- Queued emails for faster checkout

## License
Open source for learning and portfolio purposes.