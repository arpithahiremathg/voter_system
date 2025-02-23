# Laravel 10 Voter Registration System

## 📌 Prerequisites

Make sure you have the following installed:

-   PHP 8.1 or later
-   Composer
-   MySQL
-   Node.js & npm (for frontend assets)
-   Laravel 10

---

## 🚀 Installation Steps

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/arpithahiremathg/voter_system.git
cd voter_system
```

### 2️⃣ Install Dependencies

```bash
composer install
npm install
```

### 3️⃣ Set Up Environment Variables

Copy the `.env.example` file to `.env` and update database credentials:

```bash
cp .env.example .env
```

Edit `.env`:

```dotenv

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=voter_id_system
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

### 5️⃣ Run Migrations & Seed Database

```bash
php artisan migrate:fresh --seed

```

This will create necessary tables and seed initial data.

### 6️⃣ Serve the Application

```bash
php artisan serve
```

Visit: `http://127.0.0.1:8000`

---

## 📂 Running Frontend

```bash
npm run dev
```

## 🛠 Useful Commands

-   Clear Cache:
    ```bash
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    php artisan view:clear
    ```
-   Restart Server:
    ```bash
    php artisan serve
    ```
-   Recompile Assets:
    ```bash
    npm run build
    ```

---

## 📝 API Endpoints (If Applicable)

| Method | Endpoint       | Description          |
| ------ | -------------- | -------------------- |
| GET    | `/voters`      | List all voters      |
| POST   | `/voters`      | Register a new voter |
| DELETE | `/voters/{id}` | Delete a voter       |
