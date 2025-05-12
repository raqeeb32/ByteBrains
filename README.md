# ByteBrains
Final Year LMS Project


**Instructions to Run the Project Using XAMPP:**

Install XAMPP
Start Apache and MySQL
Place the Project in the htdocs Folder:
Copy your project folder (e.g., prj) to the htdocs directory, typically located at: C:\xampp\htdocs\

**Import the Database:**

Open your browser and go to http://localhost/phpmyadmin.
Create a new database bytebrainsdb.
Import the SQL file for your project.
Configure the Database Connection:
pen the database configuration file in your project (e.g., inc/db_con.php).
Ensure the database credentials match your local setup:

// <?php
$host = 'localhost';
$dbname = 'bytebrainsdb'; 
$username = 'root'; 
$password = ''; 
//

**Access the Project in the Browser:**

Open your browser and navigate to: **http://localhost/prj**


**Basic Requirements**
Software:

XAMPP (or any local server with PHP and MySQL support).
A web browser (e.g., Chrome, Firefox).
Project Files:

Ensure all project files (PHP, CSS, JS, etc.) are in the project folder.
Include the .sql file for the database (if applicable).
Database:

A MySQL database with the required tables and data.
PHP Version:

Ensure the PHP version in XAMPP matches the version required by your project.
Permissions:

Ensure the htdocs folder and project files have the necessary read/write permissions.
    
