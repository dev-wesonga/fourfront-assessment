# Money Tracker API

## Overview

This project implements a Money Tracker API using Laravel.  
It allows users to create accounts, manage multiple wallets, and record income and expense transactions. No authentication is required.

---

## Core Features

- Create user account
- Create multiple wallets per user
- Add income and expense transactions to a wallet
- View user profile with:
    - All wallets
    - Individual wallet balances
    - Total balance across all wallets
- View a specific wallet with:
    - Wallet balance
    - All associated transactions

---

## API Endpoints

### Create User

POST /api/users

### View User Profile

GET /api/users/{id}

Returns:

- All user wallets
- Each wallet balance
- Total balance

---

### Create Wallet

POST /api/wallets

### View Wallet

GET /api/wallets/{id}

Returns:

- Wallet balance
- All transactions for that wallet

---

### Add Transaction

POST /api/wallets/{id}/transactions

Request Body:

- type (income | expense)
- amount (positive number)
- description (optional)

---

## Setup Instructions

1. Clone the repository and Navigate to the money-tracker-api folder
2. Install dependencies  
   composer install

3. Copy environment file and set up database  
   cp .env.example .env

4. Generate application key  
   php artisan key:generate

5. Run database migrations  
   php artisan migrate

6. Start the development server  
   php artisan serve

---

## Tech Stack

- PHP
- Laravel
- MySQL
