<div align="center">

# 🥗 Smart Food Waste Reduction System

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel"/>
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"/>
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL"/>
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5"/>
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3"/>
  <img src="https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap"/>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/License-MIT-green?style=flat-square" alt="License"/>
  <img src="https://img.shields.io/badge/Status-Active-brightgreen?style=flat-square" alt="Status"/>
  <img src="https://img.shields.io/badge/PRs-Welcome-blue?style=flat-square" alt="PRs Welcome"/>
</p>

<br/>

> A full-stack web application built with Laravel that helps communities reduce food waste by connecting food providers with users who can claim available food items — before they go to waste.

<br/>

<!-- Replace with your actual screenshot -->
<!-- ![App Screenshot](screenshots/homepage.png) -->

</div>

---

## 📋 Table of Contents

- [About the Project](#-about-the-project)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Getting Started](#-getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#-usage)
- [Project Structure](#-project-structure)
<!-- - [Screenshots](#-screenshots) -->
- [Roadmap](#-roadmap)
- [Contributing](#-contributing)
<!-- - [License](#-license) -->
- [Contact](#-contact)

---

## 🌱 About the Project

The **Smart Food Waste Reduction System** is a community-driven platform designed to tackle food waste at a local level. Admins can post available food items, manage listings, and customize the platform — while registered users can browse, view, and engage with food offerings in real time.

The system promotes sustainability by making surplus food visible and accessible, encouraging redistribution rather than disposal.

---

## ✨ Features

### 👤 User Features
- 🔐 **Secure Authentication** — Register, log in, and manage sessions
- 🏠 **Food Listings Homepage** — Browse all available food items at a glance
- 🔢 **Item Quantity Display** — See how many units of each item are available
- 📬 **Contact Form** — Reach out to admins directly through the platform

### 🛠️ Admin Features
- ➕ **Add Food Items** — Post new food listings with details and quantity
- ✏️ **Edit Food Items** — Update existing listings in real time
- 🗑️ **Delete Listings** — Remove items that are no longer available
- 🏷️ **Editable Header/Branding** — Customize the site header name dynamically
- 👥 **User Management** — Oversee registered users on the platform

### 🔒 Security
- Role-based access control (Admin vs User)
- CSRF protection on all forms
- Authenticated routes with middleware

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| **Backend Framework** | Laravel 10.x (PHP) |
| **Database** | MySQL via phpMyAdmin |
| **Frontend** | HTML5, CSS3, Bootstrap |
| **Authentication** | Laravel Breeze / Auth |
| **ORM** | Eloquent ORM |
| **Templating** | Blade Templates |
| **Dev Environment** | XAMPP / Laravel Artisan |

---

## 🚀 Getting Started

### Prerequisites

Make sure you have the following installed:

- [PHP](https://www.php.net/) >= 8.1
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) (via XAMPP or standalone)
- [Node.js & NPM](https://nodejs.org/) (for frontend assets)

---

### Installation

**1. Clone the repository**
```bash
git clone https://github.com/your-username/smart-food-waste-reduction.git
cd smart-food-waste-reduction
```

**2. Install PHP dependencies**
```bash
composer install
```

**3. Install frontend dependencies**
```bash
npm install && npm run dev
```

**4. Set up environment variables**
```bash
cp .env.example .env
php artisan key:generate
```

**5. Configure your database in `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sfwr
DB_USERNAME=root
DB_PASSWORD=
```

**6. Run database migrations**
```bash
php artisan migrate
```

**7. (Optional) Seed sample data**
```bash
php artisan db:seed
```

**8. Start the development server**
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser. 🎉

---

## 🖥️ Usage

### As an Admin
1. Log in with admin credentials
2. Navigate to the **Admin Panel**
3. Add, edit, or remove food listings
4. Customize the site header from the settings panel

### As a User
1. Register for an account or log in
2. Browse the homepage for available food items
3. View quantities and details for each listing
4. Use the **Contact Form** to get in touch with the admin

---

## 📁 Project Structure

```
smart-food-waste-reduction/
│
├── app/
│   ├── Http/Controllers/       # Auth, Admin, Food, Contact controllers
│   ├── Models/                 # User, Food, SiteSettings models
│   └── Middleware/             # Admin role middleware
│
├── database/
│   ├── migrations/             # Table schemas
│   └── seeders/                # Sample data seeders
│
├── resources/
│   ├── views/
│   │   ├── admin/              # Admin panel views
│   │   ├── foods/              # Food listing views
│   │   ├── auth/               # Login & Register views
│   │   └── layouts/            # Main app layout
│   └── css/                    # Custom stylesheets
│
├── routes/
│   └── web.php                 # Application routes
│
└── public/                     # Publicly accessible assets
```

<!-- ---

## 📸 Screenshots

> *(Add your screenshots here by placing images in a `/screenshots` folder)*

| Page | Preview |
|---|---|
| 🏠 Homepage | `screenshots/homepage.png` |
| 🛠️ Admin Panel | `screenshots/admin-panel.png` |
| 🔐 Login Page | `screenshots/login.png` |
| 📬 Contact Form | `screenshots/contact.png` | -->

---

## 🗺️ Roadmap

Planned improvements for future versions:

- [ ] 🟡 Expiry date tracking with status badges (Fresh / Expiring Soon / Expired)
- [ ] 📊 Admin dashboard with food waste analytics & charts
- [ ] 🙋 Food claim/request system for users
- [ ] 🔍 Search and filter by category or expiry
- [ ] 📡 REST API endpoints for mobile integration
- [ ] 🌐 Deployment on Railway / Render

---

## 🤝 Contributing

Contributions are welcome! If you'd like to improve this project:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m 'Add some feature'`
4. Push to the branch: `git push origin feature/your-feature`
5. Open a Pull Request

<!-- ---

## 📄 License

This project is licensed under the **MIT License** — see the [LICENSE](LICENSE) file for details. -->

---

## 📬 Contact

**Sharath Chandra** — Computer Science Student @ SRH University Munich

[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)](https://linkedin.com/in/sharath-c1)
[![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/sharathchandra-dev)

---

<div align="center">
  <sub>Built with ❤️ to reduce food waste, one listing at a time.</sub>
</div>