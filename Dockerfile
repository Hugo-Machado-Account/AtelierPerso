# Utilise l'image PHP 8.0 avec Apache
FROM php:8.0-apache

# Copie le code de l'application dans le répertoire par défaut d'Apache
COPY . /var/www/html/

# Installe l'extension PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Expose le port 80
EXPOSE 80

# Démarre le serveur Apache en premier plan
CMD ["apache2-foreground"]
