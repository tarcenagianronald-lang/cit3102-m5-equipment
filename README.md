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