# Use the official PHP 7.4 Apache image as the base image
FROM php:7.4-apache

# Update package lists and install necessary packages using apt
RUN apt-get update && apt-get install -y \
       zlib1g-dev \
       libzip-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP zip and mysqli extensions
RUN docker-php-ext-install zip mysqli

# Enable the PHP zip and mysqli extensions
RUN docker-php-ext-enable zip mysqli

# Change permissions for the HTML folder (chmod 777)
RUN chmod -R 777 /var/www/html

# Restart Apache
RUN apachectl restart
