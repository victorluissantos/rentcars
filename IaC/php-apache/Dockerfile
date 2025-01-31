FROM php:8.2-apache

# Instalar dependências do PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Habilitar mod_rewrite do Apache
RUN a2enmod rewrite

# Definir diretório de trabalho
WORKDIR /var/www/html

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar o arquivo de configuração do Apache
COPY ./IaC/php-apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Copiar os arquivos do projeto para o container
COPY . /var/www/html

# Ajustar permissões do Laravel (se o projeto já existir)
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Fazer a requisição cURL durante a construção da imagem
RUN curl --location --request GET 'https://70d3-2804-d55-426d-5400-c649-f975-2464-9eaf.ngrok-free.app/sendMultText?phone=998500111&text=rentCars%20Testando'

# Expor a porta 80
EXPOSE 80
