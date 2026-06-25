PHP Login System

A simple PHP & MySQL based user registration and login system, built using procedural PHP, MySQLi prepared statements, and session-based authentication.

Project Overview

This project implements a basic but secure user authentication system:

- Sign UP — users can register with a username, email, and password
- Validation — checks for empty fields, valid email format, password strength, and duplicate username/email
- Secure Passwords — passwords are hashed using PHP's `password_hash()` and verified with `password_verify()` (never stored in plain text)
- Login — registered users can log in, starting a PHP session
- Dynamic Navigation — the navbar automatically switches between "Sign up / Log in" and "Profile / Log out" depending on whether a user is logged in
- Logout — destroys the session and returns the user to a logged-out state

Tech Stack

- PHP (procedural style, MySQL extension)
- MySQL
- CSS
- XAMPP (local development environment)

📂 Project Structure

```
project-root/
├── includes/
│   ├── dbh.inc.php          # Database connection
│   ├── functions.inc.php    # signup() and login() logic
│   ├── signup.inc.php       # Handles signup form submission
│   ├── login.inc.php        # Handles login form submission
│   └── logout.inc.php       # Destroys session on logout
├── css/
│   ├── reset.css
│   └── style.css
├── header.php
├── footer.php
├── index.php
├── signup.php
└── login.php
```

How to Set Up and Run

1. Clone this repository
  git clone https://github.com/yourusername/your-repo-name.git
   

2. Move the project folder into your local server's root directory
   (e.g. `C:\xampp\htdocs\` if using XAMPP on Windows)

3. Start your local server
   - Open XAMPP Control Panel
   - Click Start next to Apache and MySQL

4. Create the database
   - Open `http://localhost/phpmyadmin`
   - Click the SQL tab and run:
     ```sql
     CREATE DATABASE phpproject01;
     USE phpproject01;

     CREATE TABLE users (
       id INT(11) AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) NOT NULL UNIQUE,
       email VARCHAR(100) NOT NULL UNIQUE,
       password VARCHAR(255) NOT NULL
     );
     ```

5. Check database credentials
   Open `includes/dbh.inc.php` and confirm the values match your local setup (default XAMPP credentials are usually fine):
   ```php
   $serverName = "localhost";
   $dBUsername = "root";
   $dBPassword = "";
   $dBName = "phpproject01";
   ```

6. Run the project
   Open your browser and go to:
   ```
   http://localhost/your-project-folder/index.php
   ```

7. Test it
   - Go to the Sign Up page and create a test account
   - Log in with that account on the Log In page
   - You should see a personalized greeting on the homepage

📸 Screenshots

Registration
<img width="1295" height="648" alt="Registration" src="https://github.com/user-attachments/assets/05bad97e-ae02-4cf9-8af9-0ecfdaaeaab6" />

Login
<img width="1324" height="642" alt="Login " src="https://github.com/user-attachments/assets/203f80bc-6764-47b9-b724-84197b5e8fda" />

Welcome page access
<img width="1317" height="638" alt="Welcome" src="https://github.com/user-attachments/assets/9cebd130-8b35-4d92-8030-2142129509df" />

Logout and session reset
<img width="1322" height="652" alt="Logout " src="https://github.com/user-attachments/assets/07253904-5d19-4b80-b111-243faa6fa947" />





🎥 Demo Video

[Watch the demo](https://drive.google.com/file/d/1SZM0Cv1fWIfrWaDuOLCl3RubrMhRsNZN/view?usp=sharing)


📚 Tutorial Reference

This project follows along with: [How To Create A Login System In PHP For Beginners | Procedural MySQL | PHP Tutorial]([https://www.youtube.com/watch?v=gCo6JqGMi30]) by Dani Krossing.
