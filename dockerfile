FROM php:7.4-apache

# Install required packages and enable PHP extensions
RUN apt-get update && \
    apt-get install -y \
        default-mysql-client \
    && docker-php-ext-install mysqli pdo_mysql

# Other configurations and settings can be added here if needed

# Start Apache
CMD ["apache2-foreground"]
