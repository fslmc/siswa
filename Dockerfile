# Use an official PHP 8.1 image as the base
FROM php:8.2-fpm

# Set the working directory to /app
WORKDIR /app

# Create a new user
RUN useradd -ms /bin/false appuser

# Install Composer as root
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Create the vendor directory and change its ownership
RUN mkdir /app/vendor && chown appuser:appuser /app/vendor

# Install zip and unzip
RUN apt-get update && apt-get install -y zip unzip

# Install Git
RUN apt-get update && apt-get install -y git

# Switch to the appuser
USER appuser

# Copy the composer.lock and composer.json files
COPY composer.lock composer.json /app/

# Install the dependencies
RUN composer install --no-dev --prefer-dist

# Copy the application code
COPY . /app/

# Expose the port
EXPOSE 9000

# Run the command to start the development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]