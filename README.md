# Course Enrollment System

## 📌 Overview
The **Course Enrollment System** is a web-based application designed to allow students to securely register for courses, manage their enrollment, and access course details. Built using PHP, MySQL, and the MVC (Model-View-Controller) architecture, this system ensures efficient course management with a user-friendly interface.

## 🚀 Features
- **User Authentication**: Secure login and registration for students.
- **Course Management**: View, enroll in, and drop courses.
- **Student Dashboard**: Personalized dashboard for students to track registered courses.
- **Admin Panel**: Manage users, courses, and enrollment records.
- **Secure Database**: Uses MySQL and PDO for database interactions.

## 🛠️ Tech Stack
- **Backend**: PHP (MVC Architecture)
- **Database**: MySQL (PDO for database connection)
- **Frontend**: HTML, CSS, JavaScript (Bootstrap for UI)
- **Version Control**: Git & GitHub

## 📖 Setup Instructions
1. Clone this repository:
   ```sh
   git clone https://github.com/JacobColburn/CourseManagementSystem.git
   ```
2. Set up a local server using **XAMPP** or **WAMP**.
3. Create a MySQL database and import the provided `database.sql` file.
4. Configure database connection in `/config/database.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'course_enrollment');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```
5. Start your server and access the system via:
   ```
   http://localhost/CourseManagementSystem
   ```

## 📜 License
This project is open-source and available under the [MIT License](LICENSE).

## 🤝 Contributing
Feel free to submit pull requests or open issues if you find any bugs!

## 📩 Contact
For any queries, reach out to **Jacob Colburn** at [Your Email] or visit my [GitHub Profile](https://github.com/JacobColburn).
