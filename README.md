# Laravel Ticketing System 🚀

A **complete, production-ready helpdesk/ticketing system** built with **Laravel 12**.

Fully responsive, role-based (Customer, Agent, Admin), with image upload, threaded comments, feedback, reopen tickets, soft delete, and more.

Perfect for support teams, SaaS products, or internal ticketing.

---

## ✨ Features

- **Customer Portal**
  - Create tickets with multiple image attachments
  - Threaded conversations
  - Give feedback & rating
  - Reopen ticket if not satisfied (multiple times)
  - View ticket history

- **Agent Dashboard**
  - View only assigned tickets
  - Reply and update status/priority
  - Personal performance stats

- **Admin Panel**
  - View & manage all tickets
  - Assign tickets to agents
  - Full user management (create/edit roles)
  - Category management
  - Soft delete & restore

- **General**
  - Mobile-responsive + PWA ready
  - Clean Bootstrap 5 design
  - Secure role-based access
  - Privacy & Terms pages

---

## 📸 Screenshots

### Login
![Login](https://github.com/nakvi/laravel-ticketing-system/blob/main/public/ScreenShot/login.png)

### Registration
![Registration](https://github.com/nakvi/laravel-ticketing-system/blob/main/public/ScreenShot/signup.png)

### Customer Dashboard
![Customer Dashboard](https://github.com/nakvi/laravel-ticketing-system/blob/main/public/ScreenShot/user-dashboard.png)

### Create Ticket
![Create Ticket](https://github.com/nakvi/laravel-ticketing-system/blob/main/public/ScreenShot/user-createtickets.png)

### Ticket Details (Customer)
![Ticket Details](https://github.com/nakvi/laravel-ticketing-system/blob/main/public/ScreenShot/user-detials.png)

### Agent Dashboard
![Agent Dashboard](https://github.com/nakvi/laravel-ticketing-system/blob/main/public/ScreenShot/agent-dashboard.png)

### Admin Dashboard
![Admin Dashboard](https://github.com/nakvi/laravel-ticketing-system/blob/main/public/ScreenShot/admin-dashboard.png)

### Admin - All Tickets
![All Tickets](https://github.com/nakvi/laravel-ticketing-system/blob/main/public/ScreenShot/admin-alltickets.png)

### Admin - User Management
![User Management](https://github.com/nakvi/laravel-ticketing-system/blob/main/public/ScreenShot/admin-user.png)


---

## 🛠 Tech Stack

- Laravel 12
- PHP 8.2+
- MySQL
- Bootstrap 5
- Blade Templates
- Laravel Breeze (Authentication)

---

## 🚀 Installation

```bash
git clone https://github.com/your-username/laravel-ticketing-system.git
cd laravel-ticketing-system

composer install
npm install && npm run build

cp .env.example .env
php artisan key:generate
php artisan storage:link

# Setup database in .env
php artisan migrate --seed

php artisan serve


👥 Test Accounts
Role,Email,Password
Customer,zain@example.com,11223344
Agent,emma@support.com,password123
Admin,admin@example.com,password123

📄 Legal
Privacy Policy
Terms of Service