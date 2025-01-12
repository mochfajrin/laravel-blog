FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update \
  && apt-get install -y \
  git \
  curl \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  zip \
  unzip \
  zlib1g-dev \
  libpq-dev \
  libzip-dev \
  nodejs \
  npm \
  vim


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# install docker

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip bcmath
RUN docker-php-ext-install intl

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

# installing dependency

RUN npm install
RUN npm run build
RUN composer install

# laravel optimize and link

RUN php artisan optimize:clear
RUN php artisan filament:optimize
RUN php artisan filament:optimize-clear
RUN php artisan storage:link

# Add user for laravel application
# Create system user to run Composer and Artisan Commands

# Copy directory project permission ke container
COPY --chown=www-data:www-data . /var/www/
RUN chown -R www-data:www-data /var/www

USER www-data

EXPOSE 9000

CMD ["php-fpm"]
