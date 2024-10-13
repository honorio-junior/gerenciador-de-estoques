FROM php:8.3-cli

# Instala as dependencias necessárias
RUN apt-get update -y && apt-get install -y git  \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        unzip
RUN docker-php-ext-install zip

# Define o php.ini como development
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Diretório de trabalho
WORKDIR /app
    
# Instala o Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Copia o script para o container
COPY start.sh .

# Dê permissão de execução ao script
RUN chmod +x start.sh

# Eexecução do container
# CMD ["sh", "start.sh"]
CMD ["/bin/bash"]
