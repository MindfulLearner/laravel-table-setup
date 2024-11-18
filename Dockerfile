# Usa l'immagine base PHP con Apache
FROM php:8.2-apache

# Imposta la directory di lavoro
WORKDIR /var/www/html

# Abilita il Mod Rewrite di Apache
RUN a2enmod rewrite

# Installa le librerie di sistema necessarie
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev

# Imposta la root del documento su /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Modifica il file di configurazione di Apache per usare /public come DocumentRoot
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

RUN mkdir -p /var/www/html/public && \
    chown -R www-data:www-data /var/www/html/public && \
    chmod -R 755 /var/www/html/public && \
    echo '<Directory /var/www/html/public/>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/custom.conf && \
    a2enconf custom.conf

# Copia Composer dall'immagine ufficiale e rendilo disponibile
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installa le estensioni PHP necessarie
RUN docker-php-ext-install gettext intl pdo_mysql

# Configura e installa GD (libreria per la gestione di immagini)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd


