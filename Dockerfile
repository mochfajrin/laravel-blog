FROM php:8.2-fpm

WORKDIR /var/www

COPY . .

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
  npm


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# install docker

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip bcmath
RUN docker-php-ext-install intl

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN npm install
RUN composer install
RUN npm run build


EXPOSE 9000
CMD ["php-fpm"]
