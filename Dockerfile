FROM php:8.3-fpm-alpine

WORKDIR /var/www/html
RUN addgroup -S 1000 && adduser -S friend --uid 1000 -G 1000

RUN apk update --no-cache \
&& apk add \
bash \
curl \
icu-dev \
oniguruma-dev \
tzdata \
supervisor \
unzip \
zip \
libzip-dev \
htop \
mysql-client \
postgresql-dev \
less \
gmp-dev \
ghostscript \
nano \
libpng-dev \
libjpeg-turbo-dev \
libwebp-dev \
libxpm-dev \
freetype-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
    && docker-php-ext-install gd \
    && docker-php-ext-install intl \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install gmp \
    && docker-php-ext-install exif

# Adiciona o build para o Xdebug e Redis
RUN apk add --update linux-headers \
    && apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug redis \
    && docker-php-ext-enable xdebug redis \
    && rm -rf /tmp/pear

RUN docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

COPY php.ini /usr/local/etc/php/conf.d/99-sail.ini
COPY docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Permissões para o usuário friend
RUN chown -R friend:1000 /var/www/html
USER friend
