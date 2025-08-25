FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Enable Apache mod_rewrite
RUN a2enmod rewrite headers

# Copy existing application directory contents
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Set directory permissions for Apache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Set permissions for Laravel directories
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install npm dependencies and build resources
RUN npm install && npm run build

# Copy Apache config
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copy and make entrypoint executable
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Debugging step: Check permissions
RUN ls -l /entrypoint.sh

# Expose port 80
EXPOSE 80

# Start Apache using the entrypoint script
ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]
