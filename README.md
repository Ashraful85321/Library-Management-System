# 📚 Library-Management-System

This is a Laravel-based project that uses Tailwind CSS and MySQL. It is intended to be run locally using XAMPP.The project aims to make library management easier for administrators by providing an intuitive web interface for managing books, students, and librarians. It also offers the ability to monitor borrowed books and manage the inventory efficiently.

# 💼 Features:

- CRUD Operations on Database:

  - Librarians: Add, update, delete, and view librarian, student and book records.

  - Students: Update and view own record. View books.

  - Books: Add, update, delete, and view book records by the librarian. View by the students.

  - Search: Both librarian and students can perform search and advanced search operation on their accessable data.

- Book Requests & Borrowing:

  - Track books that are requested by students and their status.

  - Keep track of borrowed books and their due dates.

  - View and manage book return status.

- Responsive Design:

  The system is fully responsive, meaning it will adapt to various screen sizes, providing a great user experience on mobile devices, tablets, and desktops.

---

## 🚀 Getting Started

Follow these steps to run the project on your local machine.

### ✅ Requirements

- XAMPP (PHP 8+ and MySQL)
- Composer (PHP package manager)
- Node.js & npm (optional — only needed if modifying frontend assets)

---

### 🔧 Installation Steps

1. **Clone the Repository**

   ```bash
   git clone https://github.com/Ashraful85321/Library-Management-System.git
   ```

   Alternatively, you can download the ZIP file and extract it.

2. **Move the Project to XAMPP’s htdocs Directory**

   Move the project folder into:

   C:\xampp\htdocs\

   For example:

   C:\xampp\htdocs\Library-Management-System\

3. **Install Composer Dependencies**

You need to have Composer installed. Then navigate to the project directory in the terminal:

```bash
cd C:\xampp\htdocs\example-app
composer install
```

4. **Create .env File**

Copy the .env.example file and rename it to .env:

```bash
copy .env.example .env
```

5.**Generate Application Key**

Run:

```bash
php artisan key:generate
```

6. **Configure .env File for Database**

Edit the .env file and update these lines for their XAMPP MySQL setup:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

7. **Run Migrations to create database.**

To create the necessary database run migrations with:

```bash
php artisan migrate
```

8. **Create an entry**

To manually create the first top level entry(librarian) run xampp server, goto this [link](http://localhost/phpmyadmin/index.php?route=/database/sql&db=my-db) and run the query:

```query
INSERT INTO libuser (name, dbman, email, password, created_at, updated_at)
VALUES ('librarian1', 'yes', 'librarian1@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa6x.F8VfsaL/j0RG8K0w1y6UXW', NOW(), NOW());
```

This creates a default librarian user with:

    Email: librarian1@example.com

    Password: 1234

8. Serve the Project

Use Laravel’s built-in server by running:

```bash
php artisan serve
```

# 💻 Run the Project

Goto this [link](http://127.0.0.1:8000/newlogin) which will bring the login page.
Enter the previously created email and passward.
From here on you are ready to operate through the interface.
Note that librarian can create student entry and logging in as a student will show different type of options and views.

# 📃 Additional Information

This project was developed for educational purposes and serves as a learning tool. Throughout the development process, inspiration and guidance were drawn from various publicly available resources, tutorials, and documentation.
Please note that not all URLs within the application may be accessible to every user due to permission or authentication constraints. For the best experience, it is recommended to navigate through the application using the provided user interface, which ensures proper routing and access control.
