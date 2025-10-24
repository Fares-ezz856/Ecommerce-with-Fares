FROM php:8.2-apache

# تثبيت مكتبات Laravel
RUN docker-php-ext-install pdo pdo_mysql

# تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# نسخ ملفات المشروع
COPY . /var/www/html

# تفعيل rewrite
RUN a2enmod rewrite
