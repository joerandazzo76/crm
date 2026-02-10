FROM php:8.4-fpm

# System deps
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libonig-dev \
        libzip-dev \
        libicu-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        intl \
        mbstring \
        pdo_mysql \
        zip \
        gd \
        opcache

# Redis (optional but used by many Laravel setups)
RUN pecl install redis \
    && docker-php-ext-enable redis

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]
CMD ["php-fpm"]
