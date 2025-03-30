# Fake Transactions - Laravel Application Documentation

## Overview
Fake Transactions is a Laravel-based application that generates and sends randomized API requests to a third-party endpoint at scheduled intervals. The application is designed to simulate financial transactions and test external API integrations.

## Repository
GitHub Repository: [Fake Transactions](git@github.com:Cran-Stack/faketransactions.git)

## File Structure
```
faketransactions/
│── app/
│   ├── Console/
│   │   ├── Commands/
│   │   │   ├── SendFakeTransactions.php  # Command for sending transactions
│   ├── Providers/
│   │   ├── FakeTransactionServiceProvider.php  # Service provider for transactions
│   ├── Services/
│   │   ├── FakeTransactionService.php  # Service handling transaction logic
│
│── config/
│   ├── faketransactions.php  # Configuration file for transactions and third-party endpoint
│
│── database/
│   ├── migrations/
│   │   ├── 2024_xx_xx_create_transactions_table.php  # Migration file for transactions
│
│── routes/
│   ├── api.php  # API routes
│
│── .env.example  # Environment variable example file
│── .env  # Environment configuration (ignored in version control)
│── artisan  # Laravel CLI tool
│── composer.json  # Dependencies and project configuration
│── package.json  # Node.js dependencies (if applicable)
```

## Setting Up the Project

### 1. Clone the Repository
```sh
git clone git@github.com:Cran-Stack/faketransactions.git
cd faketransactions
```

### 2. Install Dependencies
```sh
composer install
```

### 3. Copy Environment Configuration
```sh
cp .env.example .env
```

### 4. Configure the `.env` File
Update the `.env` file with database credentials and third-party API URL:
```
THIRD_PARTY_API_URL=http://localhost:3000/api/v1/transactions/screen
```

### 5. Generate Application Key
```sh
php artisan key:generate
```

### 6. Run Database Migrations
```sh
php artisan migrate
```

## Where the Code is Written
- **Transaction Logic:** `app/Services/FakeTransactionService.php`
- **Scheduled Command:** `app/Console/Commands/SendFakeTransactions.php`
- **Configuration:** `config/faketransactions.php`
- **Routes:** `routes/api.php`

## Setting Up Crontab on Mac

To schedule the Laravel task every minute:

1. Open the crontab editor:
```sh
crontab -e
```

2. Add the following line at the end:
```sh
* * * * * cd /path/to/faketransactions && php artisan schedule:run >> /dev/null 2>&1
```
(Replace `/path/to/faketransactions` with the actual path to your project.)

3. Save and exit.

4. Verify the crontab is running:
```sh
crontab -l
```

### Restarting the Cron Service on Mac
If the cron service is not running, restart it with:
```sh
sudo launchctl stop com.apple.cron
sudo launchctl start com.apple.cron
```

## Running the Application
To manually trigger the fake transaction command:
```sh
php artisan send:fake-transactions
```

Your Laravel application is now set up and ready to generate fake transactions!

