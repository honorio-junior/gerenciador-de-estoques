#!/bin/sh

# Instala as dependências do Composer
composer install --no-interaction --prefer-dist --optimize-autoloader

# Gera a chave da aplicação
php artisan key:generate

# Executa as migrações
php artisan migrate

# Inicia o servidor
php artisan serve --host=0.0.0.0 --port=8000
