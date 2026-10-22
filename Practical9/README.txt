WEB DEVELOPMENT FRAMEWORKS - PRACTICAL 9
Secure Registration using MySQLi and password_hash()

FILES
- index.php       Registration form
- db_mysqli.php   MySQLi database connection
- register.php    Validates input and stores a password hash
- setup.sql       Creates the practical9_users table

INSTALLATION
1. Copy the Practical9 folder into:
   C:\xampp\htdocs\StudentHub\

2. Start Apache and MySQL from XAMPP.

3. Open http://localhost/phpmyadmin
   Select your existing StudentHub database.
   Open the Import tab and import setup.sql.
   Alternatively, open the SQL tab and run the contents of setup.sql.
   This creates a separate table named practical9_users and does not delete
   your existing tables.

4. Open db_mysqli.php and verify the $database value.
   It is currently set to "student hub" because that name appeared in the
   earlier phpMyAdmin URL. If your exact database name is different, change it.
   The default XAMPP settings used here are username root and blank password.
   If your MySQL account uses a password, update $password.

5. Visit:
   http://localhost/StudentHub/Practical9/index.php

TESTING
- Register with a new name, email and password of at least 8 characters.
- A successful registration should show "Registration successful!"
- Try the same email again; it should say the email is already registered.
- In phpMyAdmin, open practical9_users and inspect the row.
  The password_hash column should contain a hash, not the original password.

SECURITY CONCEPTS
- password_hash() stores a password hash.
- Prepared statements help protect SQL queries from SQL injection.
- Email validation checks the email format.
- A UNIQUE email column prevents duplicate email addresses.
- Do not store or display the original password.
