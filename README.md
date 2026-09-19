# ☕ Coffee Shop Inventory Management System

A web-based inventory management system designed to help coffee shops manage their products, ingredients, stock movements, and low-stock items efficiently.

## 📌 Project Overview

The **Coffee Shop Inventory Management System** is a Laravel-based web application that provides an organized way to manage coffee shop inventory.

The system allows administrators to manage products and ingredients, record stock-in and stock-out transactions, monitor inventory levels, and identify ingredients that have reached their minimum stock level.

## ✨ Features

- 🔐 Admin Login and Registration
- 📊 Dashboard with Inventory Statistics
- 📦 Product Management
- 🏷️ Category Management
- 🧂 Ingredient Management
- 📥 Stock In Management
- 📤 Stock Out Management
- ⚠️ Low Stock Monitoring
- 🔄 Automatic Stock Updates
- 🗑️ Add, Edit, and Delete Records
- 🔒 Protected Admin Routes
- 🗄️ MySQL Database Integration

## 🛠️ Technologies Used

| Technology   | Purpose                       |
| ------------ | ----------------------------- |
| PHP          | Backend Programming           |
| Laravel 12   | Web Application Framework     |
| MySQL        | Database Management           |
| Blade        | Laravel Template Engine       |
| HTML5        | Page Structure                |
| CSS          | Styling                       |
| Tailwind CSS | User Interface                |
| JavaScript   | Client-side Interaction       |
| Git          | Version Control               |
| GitHub       | Source Code Repository        |
| XAMPP        | Local Development Environment |

## 📂 Main Modules

### Dashboard

Provides an overview of the inventory system, including:

- Total Products
- Total Ingredients
- Stock In Records
- Stock Out Records
- Low Stock Items

### Product Management

Administrators can:

- Add products
- Edit products
- Delete products
- Assign products to categories
- Manage product prices and stock

### Category Management

Administrators can organize products using categories.

### Ingredient Management

Administrators can manage:

- Ingredient name
- Description
- Unit
- Current stock
- Minimum stock
- Cost per unit

### Stock In

Records incoming ingredients and automatically increases the current ingredient stock.

### Stock Out

Records outgoing ingredients and automatically decreases the current ingredient stock.

The system also checks whether sufficient stock is available before recording a stock-out transaction.

### Low Stock Monitoring

The system identifies ingredients where:

```text
Current Stock <= Minimum Stock
```

These ingredients are displayed on the Low Stock page and dashboard.

## 🔐 Authentication

The system includes a simple administrator authentication system.

Administrators can:

- Register an account
- Login
- Logout
- Access protected inventory pages

Protected routes use Laravel middleware to prevent unauthorized access.

## 🗄️ Database

The system uses **MySQL** as its database.

Main tables include:

- `admins`
- `categories`
- `products`
- `ingredients`
- `stock_ins`
- `stock_outs`

## 💻 Installation

### 1. Clone the repository

```bash
git clone https://github.com/MAKUU2/coffee-shop-inventory.git
```

### 2. Open the project

```bash
cd coffee-shop-inventory
```

### 3. Install PHP dependencies

```bash
composer install
```

### 4. Create the environment file

```bash
copy .env.example .env
```

For macOS/Linux:

```bash
cp .env.example .env
```

### 5. Generate the application key

```bash
php artisan key:generate
```

### 6. Create the database

Create a MySQL database named:

```text
coffee_shop
```

### 7. Configure `.env`

Update the database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=coffee_shop
DB_USERNAME=root
DB_PASSWORD=
```

Adjust the username and password according to your local MySQL configuration.

### 8. Run migrations

```bash
php artisan migrate
```

### 9. Start the Laravel development server

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

## 📁 Project Structure

```text
coffee-shop-inventory/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   │
│   └── Models/
│
├── database/
│   └── migrations/
│
├── resources/
│   └── views/
│       ├── auth/
│       ├── categories/
│       ├── ingredients/
│       ├── products/
│       ├── stock_ins/
│       ├── stock_outs/
│       ├── low_stock/
│       └── dashboard.blade.php
│
├── routes/
│   └── web.php
│
├── public/
├── config/
├── bootstrap/
├── tests/
│
├── composer.json
└── README.md
```

## 🎯 Learning Objectives

This project was developed to practice and demonstrate the following:

- Laravel fundamentals
- MVC architecture
- CRUD operations
- Database relationships
- MySQL database management
- Form validation
- Laravel routing
- Middleware
- Authentication
- Inventory management logic
- Git and GitHub workflow

## 🚀 Future Improvements

Possible future improvements include:

- Inventory reports
- Sales management
- User roles and permissions
- Search and filtering
- Export reports to PDF or Excel
- Product sales tracking
- Inventory history
- Improved dashboard charts
- Email notifications for low stock

## 👨‍💻 Developer

**Mark Joseph Ladot**

GitHub:

https://github.com/MAKUU2

## 📄 License

This project is created for educational and portfolio purposes.
