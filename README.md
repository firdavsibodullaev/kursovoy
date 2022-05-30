## Deploy

Системные требования: 
- PHP >= 7.4
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension 
- Tokenizer PHP Extension 
- XML PHP Extension

Конфигурации сервера:
[nginx](https://laravel.com/docs/8.x/deployment#nginx)

- git clone https://github.com/firdavsibodullaev/kursovoy.git **project_directory**
- cd **project_directory**
- composer install --optimize-autoloader --no-dev (bash-script)
- Переименовать файл .env.example => .env
- php artisan key:generate (bash-script)

## Подключение Базы данных

В файле .env:

- APP_NAME=Название проекта
- APP_URL=https://url
- APP_ENV=production
- APP_DEBUG=true (После разработки поставить **false**)


- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1 (или свой HOST)
- DB_PORT=3306 (или свой порт)
- DB_DATABASE=
- DB_USERNAME=
- DB_PASSWORD=

## Кешировать конфигурации

- php artisan config:cache (bash-script)
- php artisan route:cache (bash-script)
- php artisan view:cache (bash-script)
