# Realtime application

## Requirements

- php [7.2]
- Laravel [5.7]
- NodeJS [8.10.0]
- NPM [3.5.2]
- Redis

## Installation

After download run composer install:
```sh
composer install
php artisan key:generate
```
In main directory run:
```sh
npm install
```


##### Rename .env.example to .env
##### Add permissions for directories storage and bootstrap/cache:
```sh
sudo chmod 777 -R storage/
sudo chmod 777 -R bootstrap/cache
```
Run migrations and seeders:
```sh
php artisan migrate
php artisan db:seed
```

For speed:
```sh
npm run prod
php artisan route:cache
```

## Configuration

In .env file you must enter:
- database settings
- redis settings

Add to cron:

* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1

## Usage

for run socket.io server run:
```sh
node socket.js
```

## Troubleshooting & FAQ

- [Problem] - [Solution]
