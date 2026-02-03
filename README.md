# 📚 Laravel Book-Author-Management API

This project is a simple Laravel backend API built to manage **Authors** and their **Books**.

---

## 🚀 Features

- User Authentication (Register/Login) using Sanctum
- Authors CRUD (Create, Read, Update, Delete)
- Books CRUD (Create, Read, Update, Delete)
- One-to-Many Relationships:
    - User → Authors (Each user can be related to multiple authors)
    - Author → Books (Each author can be related to multiple books)
- Request Validation
- Protected API Routes

---

## 🛠 Requirements

Make sure your system has:

- PHP >= 8.1
- Composer
- MySQL (or any supported DB)
- Laravel >= 10
- Postman / Thunder Client (for API testing)

---

## ⚙️ Project Setup Instructions

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/NewbieAbt/book-author-management.git
cd book-author-management
```

---

### 2️⃣ Install Dependencies

```bash
composer install
```

---

### 3️⃣ Create Environment File

Copy the `.env.example` file:

```bash
cp .env.example .env
```

---

### 4️⃣ Configure Database

Update your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_author_management
DB_USERNAME=root
DB_PASSWORD=
```

---

### 5️⃣ Generate Application Key

```bash
php artisan key:generate
```

---

### 6️⃣ Run Migrations

```bash
php artisan migrate
```

### 8️⃣ Start the Server

```bash
php artisan serve
```

Server will run at:

```
http://127.0.0.1:8000
```

---

# 🔐 Authentication Endpoints

All protected routes(authors and books) require this header:

```
Authorization: Bearer YOUR_TOKEN
Accept: application/json
```

---

## ✅ Register User

**POST** `/api/register`

```json
{
    "name": "Test User",
    "email": "test@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

Response:

```json
{
    "token": "1|xxxxxx"
}
```

---

## ✅ Login User

**POST** `/api/login`

```json
{
    "email": "test@example.com",
    "password": "password"
}
```

Response:

```json
{
    "token": "1|xxxxxx"
}
```

---

# 👨‍💻 Authors API Endpoints

Base Route:

```
/api/authors
```

---

## ✅ Create Author

**POST** `/api/authors`

```json
{
    "name": "J.K. Rowling",
    "bio": "Author of Harry Potter"
}
```

---

## ✅ Get All Authors

**GET** `/api/authors`

---

## ✅ Get Single Author

**GET** `/api/authors/{id}`

Example:

```
GET /api/authors/1
```

---

## ✅ Update Author

**PUT** `/api/authors/{id}`

```json
{
    "name": "Updated Author Name",
    "bio": "Updated Author bio"
}
```

---

## ✅ Delete Author

**DELETE** `/api/authors/{id}`

---

# 📖 Books API Endpoints

Base Route:

```
/api/books
```

Books belong to Authors, so every book must include a valid `author_id`.

---

## ✅ Create Book

**POST** `/api/books`

```json
{
    "author_id": 1,
    "title": "Harry Potter",
    "description": "A fantasy novel about a young wizard."
}
```

---

## ✅ Create Book (Without Description)

```json
{
    "author_id": 1,
    "title": "Fantastic Beasts"
}
```

---

## ✅ Get All Books

**GET** `/api/books`

Response Example:

```json
[
    {
        "id": 1,
        "author_id": 1,
        "title": "Harry Potter",
        "description": "A fantasy novel about a young wizard."
    }
]
```

---

## ✅ Get Single Book

**GET** `/api/books/{id}`

Example:

```
GET /api/books/1
```

---

## ✅ Update Book

**PUT** `/api/books/{id}`

```json
{
    "title": "Harry Potter Updated",
    "description": "Updated description."
}
```

---

## ✅ Delete Book

**DELETE** `/api/books/{id}`

Example:

```
DELETE /api/books/1
```

---

# ✅ Validation Rules

## Authors Validation

| Field | Rule             |
| ----- | ---------------- |
| name  | required, string |
| bio   | nullable, string |

---

## Books Validation

| Field       | Rule                                  |
| ----------- | ------------------------------------- |
| author_id   | required, must exist in authors table |
| title       | required, string                      |
| description | nullable, string                      |

Example validation error:

```json
{
    "errors": {
        "title": ["The title field is required."]
    }
}
```

---


# 📌 Notes

- All Authors and Books are user-specific.
- Users cannot edit or delete other users’ records.
- Sanctum tokens must be passed in every request after login.

---

