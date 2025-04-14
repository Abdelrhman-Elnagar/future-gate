# Future Gate - Student Data Management Platform

## Overview

Future Gate is a platform designed to efficiently manage student data, providing a seamless way to store and retrieve information such as student names, seat numbers, and governorates. The backend is built using Laravel (PHP), exposing API endpoints to fetch student data. The frontend is developed with React (web) and Flutter (mobile), enabling users to interact with the data effortlessly.

This project is a collaborative effort:

* **Backend:** Managed by Abdelrhman Elnagar.
* **Frontend:** Developed by teammates using React and Flutter.

## Table of Contents

* [Technologies Used](#technologies-used)
* [API Endpoints](#api-endpoints)
* [For Frontend Teammates (React and Flutter)](#for-frontend-teammates-react-and-flutter)
    * [Option 1: Access the Backend Remotely (No PHP Installation)](#option-1-access-the-backend-remotely-no-php-installation)
    * [Option 2: Install PHP and Run the Backend Locally](#option-2-install-php-and-run-the-backend-locally)
* [Troubleshooting](#troubleshooting)
* [Contributing](#contributing)
* [License](#license)

## Technologies Used

* **Backend:** Laravel (PHP framework, version 11.x)
* **Database:** MySQL (local database: `future_gate_db`)
    * Database was created with Mysql version: (Insert Mysql Version Here)
* **Frontend:**
    * React (web application)
    * Flutter (mobile application)
* **Tools:**
    * Ngrok (for exposing the local backend)
    * Composer (PHP dependency manager)
    * WampServer/XAMPP (local server for PHP)

## API Endpoints

The backend provides the following API endpoints to retrieve student data:

* **`GET /api/students`**

    Retrieves a list of all students.

    Example response:

    ```json
    [
        { "id": 1, "الاسم": "أحمد محمد", "رقم_الجلوس": "12345", "المحافظة": "القاهرة" },
        { "id": 2, "الاسم": "سارة علي", "رقم_الجلوس": "12346", "المحافظة": "الجيزة" }
    ]
    ```

* **`GET /api/students/{id}`**

    Retrieves a specific student by ID.

    Example: `/api/students/1`

    Example response:

    ```json
    { "id": 1, "الاسم": "أحمد محمد", "رقم_الجلوس": "12345", "المحافظة": "القاهرة" }
    ```

## For Frontend Teammates (React and Flutter)

You have two options to retrieve student data:

1.  Access the backend remotely via API calls (no setup required).
2.  Install PHP and run the backend on your own PC.

### Option 1: Access the Backend Remotely (No PHP Installation)

You can fetch data from Abdelrhman’s local backend without installing PHP or Laravel. The backend is made accessible over the internet using Ngrok.

1.  **API Base URL**

    The current public URL is: `https://abc123.ngrok.io`.

    **Note:** This URL is temporary and changes each time the Ngrok server restarts. To obtain the most up-to-date URL, please contact Abdelrhman.

2.  **Making Requests from Your Code**

    Use the Ngrok URL to make HTTP requests to the API endpoints.

    * **React:** Use `axios` or `fetch`.

        Example with `fetch`:

        ```javascript
        async function fetchStudents() {
            const response = await fetch('[https://abc123.ngrok.io/api/students](https://abc123.ngrok.io/api/students)');
            const data = await response.json();
            console.log(data);
        }
        fetchStudents();
        ```

    * **Flutter:** Use the `http` package.

        Add to `pubspec.yaml`:

        ```yaml
        dependencies:
            http: ^1.2.1
        ```

        Then, make a request:

        ```dart
        import 'package:http/http.dart' as http;

        Future<void> fetchStudents() async {
            final response = await http.get(Uri.parse('[https://abc123.ngrok.io/api/students](https://abc123.ngrok.io/api/students)'));
            if (response.statusCode == 200) {
                print(response.body); // JSON data
            } else {
                print('Failed to load data');
            }
        }
        ```

3.  **Testing Without Code**

    * **Postman:** Create a `GET` request with the URL (e.g., `https://abc123.ngrok.io/api/students`) and hit "Send".
    * **cURL:**

        ```bash
        curl -X GET [https://abc123.ngrok.io/api/students](https://abc123.ngrok.io/api/students)
        ```

### Option 2: Install PHP and Run the Backend Locally

If you prefer to run the backend on your own PC, you’ll need to install PHP, a web server, and the project dependencies. This allows you to work offline and test the backend independently.

1.  **Prerequisites**

    * PHP: Download and install PHP (version 8.1 or higher) from [php.net](https://www.php.net/).
    * Composer: Install Composer from [getcomposer.org](https://getcomposer.org/).
    * Web Server: Install a local server:
        * WampServer (Windows): Download from [wampserver.com](https://www.wampserver.com/).
        * XAMPP (Windows/Mac/Linux): Download from [apachefriends.org](https://www.apachefriends.org/).
    * MySQL: Included with WampServer/XAMPP, or install separately from [mysql.com](https://www.mysql.com/).
    * Git: Install Git from [git-scm.com](https://git-scm.com/).

2.  **Clone the Repository**

    ```bash
    git clone [https://github.com/Abdelrhman-Elnagar/future-gate.git](https://github.com/Abdelrhman-Elnagar/future-gate.git)
    cd future-gate
    ```

3.  **Install Dependencies**

    ```bash
    composer install
    ```

4.  **Set Up Environment**

    ```bash
    cp .env.example .env
    ```

    Open the `.env` file and configure the database settings:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=future_gate_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

    (Adjust `DB_USERNAME` and `DB_PASSWORD` based on your MySQL setup.)
    **Note:** Do not commit sensitive information, like database passwords, to version control.

5.  **Set Up the Database**

    Abdelrhman will provide a copy of the database (`future_gate_db.sql`). Import it into MySQL:

    * Open phpMyAdmin (usually at `http://localhost/phpmyadmin`).
    * Create a new database named `future_gate_db`.
    * Go to the "Import" tab, upload the `future_gate_db.sql` file, and click "Go".

    Alternatively, use the MySQL command line:

    ```bash
    mysql -u root -p future_gate_db < future_gate_db.sql
    ```

6.  **Generate an Application Key**

    ```bash
    php artisan key:generate
    ```

7.  **Run the Backend**

    ```bash
    php artisan serve
    ```

    The backend will run at `http://localhost:8000`. Use this as your API base URL.

8.  **Retrieve Data**

    Use the same API endpoints as in Option 1, but with your local URL (e.g., `http://localhost:8000/api/students`).

## Troubleshooting

* **Option 1:**
    * If you can’t connect, the Ngrok URL might have changed, or Abdelrhman’s server might be down. Contact him to confirm.
    * If the data isn’t what you expect (e.g., missing fields like "الاسم"), let Abdelrhman know to check the backend.
* **Option 2:**
    * PHP Errors: Ensure PHP is in your system’s `PATH`. Test with `php -v`.
    * Database Issues: Double-check your `.env` file and MySQL credentials. Ensure MySQL is running.
    * Composer Issues: Run `composer update` if dependencies fail to install.

For any issues, reach out to Abdelrhman.

## Contributing

Contributions are welcome! If you have suggestions or improvements:

1.  Fork the repository.
2.  Create a new branch (`git checkout -b feature/your-feature`).
3.  Commit your changes (`git commit -m 'Add your feature'`).
4.  Push to the branch (`git push origin feature/your-feature`).
5.  Open a pull request.

Please follow the Contributor Covenant guidelines for respectful collaboration.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Notes for You (Abdelrhman)

* **Ngrok URL:** Replace `https://abc123.ngrok.io` with the actual Ngrok URL when you run `ngrok http 8000`. Update the README whenever the URL changes.
* **Database File:** Ensure you share the `future_gate_db.sql` file with your teammates securely (e.g., via Google Drive) for Option 2.
* **Laravel Version:** The project uses Laravel version 11.x.
* **License:** I’ve assumed an MIT License, which is common for open-source projects. If you prefer a different license, update the License section accordingly using a resource like [choosealicense.com](https://choosealicense.com/).