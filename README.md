# Equipment API

**Course / Section:** CIT3102 – IT3E

**Partners:** Gian Ronald V. Tarcena, Eijay Iverson D. Villanueva

**Resource:** Equipment (`name`, `category`, `location`, `quantity`)

A REST API built with Laravel and Sanctum. Equipment records can be created, listed, filtered, updated, and deleted by logged-in users.

## Setup

Requires PHP 8.4+ and Composer.

```bash
git clone https://github.com/tarcenagianronald-lang/cit3102-m5-equipment.git
cd cit3102-m5-equipment
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

On Windows PowerShell, use `copy .env.example .env` instead of `cp`. If `migrate` asks to create `database.sqlite`, answer Yes.

The API runs at `http://127.0.0.1:8000`. Send the header `Accept: application/json` with every request. Protected routes also need `Authorization: Bearer <token>`, which you get from `/api/register` or `/api/login`.

## Routes

| Verb | Path | What it does | Token needed? |
|---|---|---|---|
| POST | /api/register | Creates a user and returns a token | No |
| POST | /api/login | Logs in and returns a token | No |
| POST | /api/logout | Deletes the current token | Yes |
| GET | /api/me | Shows the logged-in user | Yes |
| GET | /api/equipment | Lists equipment, with optional filters on `name`, `category`, `location`, `quantity` | Yes |
| POST | /api/equipment | Creates an equipment record | Yes |
| GET | /api/equipment/{equipment} | Shows one equipment record | Yes |
| PUT | /api/equipment/{equipment} | Updates an equipment record | Yes |
| DELETE | /api/equipment/{equipment} | Deletes an equipment record | Yes |

Filter examples:

```
GET /api/equipment?category=Electronics
GET /api/equipment?category=Electronics&location=Room 101
```

## Screenshots

### 1. Register (201)
![1](docs/screenshots/01-register.jpeg)

### 2. Login (200)
![2](docs/screenshots/02-login.jpeg)

### 3. List without token (401)
![3](docs/screenshots/03-no-token-401.jpeg)

### 4. List with token (200)
![4](docs/screenshots/04-list-200.jpeg)

### 5. Create (201)
![5](docs/screenshots/05-create-201.jpeg)

### 6. Create with a missing field (422)
![6](docs/screenshots/06-validation-422.jpeg)

### 7. Show one (200)
![7](docs/screenshots/07-show-200.jpeg)

### 8. Show a record that does not exist (404)
![8](docs/screenshots/08-not-found-404.jpeg)

### 9. Update (200)
![9](docs/screenshots/09-update-200.jpeg)

### 10. Delete (204)
![10](docs/screenshots/10-delete-204.jpeg)


## Why does DELETE return 204 and not 200?

Since there is nothing left after the deletion, DELETE will return a 204 No Content response. In general, a 200 response always includes a body with information about the resource. However, this resource does not exist anymore. Therefore, it is necessary to inform the client using a 204 response that everything was fine and that there will be no body to read.