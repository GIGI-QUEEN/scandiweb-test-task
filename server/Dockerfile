# Use an official PHP runtime as a parent image
FROM php:8.1-apache

# Enable Apache mod_rewrite if you're using it
RUN a2enmod rewrite

# Install any required PHP extensions (e.g., pdo_mysql for MySQL database)
RUN docker-php-ext-install pdo pdo_mysql

# Copy your PHP source code into the container
COPY . /var/www/html/

# Ensure proper file permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 to allow access to the web server
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]