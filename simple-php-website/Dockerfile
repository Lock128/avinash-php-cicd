FROM php:8.2-apache

# Install MySQL Server
RUN apt-get update && \
    apt-get install -y default-mysql-server && \
    docker-php-ext-install pdo pdo_mysql

# Copy application files
COPY ./app/ /var/www/html/

# Copy SQL init script
COPY init.sql /docker-entrypoint-init.sql

# Setup entrypoint to run both MySQL and Apache
CMD mysqld_safe & \
    sleep 5 && \
    mysql -u root < /docker-entrypoint-init.sql && \
    apache2-foreground

