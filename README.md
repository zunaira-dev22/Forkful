# ForkFul

ForkFul is a Laravel-based online food ordering website that allows customers to browse menu items, manage a cart, place orders, and track their order history.

The application also includes an administrator dashboard for managing menu items, customers, orders, and order statuses.

## Features

### Customer Features

* Customer registration and login
* Secure authentication
* Dynamic food menu
* Category-based menu filtering
* Add items to cart
* Increase or decrease cart quantity
* Automatic cart price synchronization
* Checkout and delivery details
* Place food orders
* View personal order history
* View individual order details
* Cancel an order while it is still pending
* Track order status

### Admin Features

* Admin authentication and protected routes
* Dashboard with live statistics
* View total menu items
* View total orders
* View today's orders
* View registered customers
* View recent orders
* Add new menu items
* Edit menu items
* Delete menu items
* View customer orders
* Update order status
* View registered customers

## Order Status Flow

Orders follow this status flow:

* Pending → Preparing
* Pending → Cancelled
* Preparing → Delivered
* Delivered → Final
* Cancelled → Final

Customers can cancel an order only while its status is Pending.

## Technologies Used

* PHP 8.2+
* Laravel 12
* MySQL
* HTML5
* CSS3
* JavaScript
* Bootstrap 5

## Installation

Clone or download the project and open the project directory.

Install PHP dependencies:

```bash
composer install
```

Create the environment file:

```bash
copy .env.example .env
```

On macOS or Linux:

```bash
cp .env.example .env
```

Generate the Laravel application key:

```bash
php artisan key:generate
```

Create a MySQL database named:

```text
forkful
```

Configure the database connection in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=forkful
DB_USERNAME=root
DB_PASSWORD=
```

Run the migrations:

```bash
php artisan migrate
```

Run the database seeders if required:

```bash
php artisan db:seed
```

Start the Laravel development server:

```bash
php artisan serve
```

Open the website at:

```text
http://127.0.0.1:8000
```

## User Roles

The application supports two roles:

### Customer

Customers can browse the menu, manage their cart, place orders, view order history, and cancel pending orders.

### Admin

Administrators can access the admin dashboard, manage menu items, view customers, manage orders, and update order statuses.

## Main Project Structure

```text
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
└── Models/

database/
├── migrations/
└── seeders/

resources/
└── views/
    ├── admin/
    ├── auth/
    └── customer/

public/
├── css/
├── js/
└── images/

routes/
└── web.php
```

## Security

* Passwords are securely hashed.
* CSRF protection is enabled on forms.
* Admin routes are protected by admin middleware.
* Customer-only routes are protected by customer middleware.
* Customers can only access their own orders.
* Sensitive `.env` information should never be committed to a public repository.

## Project

ForkFul — Home-style cooking, ordered online.
