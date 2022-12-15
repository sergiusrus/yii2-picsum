FROM php:7.4-fpm

RUN apt-get update
RUN apt-get install -y \
        apt-transport-https \
        nano \
        curl \
        wget \
        git \
        zip \
        unzip \
        supervisor \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libjpeg-dev \
        zlib1g-dev \
        libpq-dev \
        libc-client-dev \
        libkrb5-dev \
        libxslt-dev \
        libonig-dev \
        libpq-dev \
        libmagickwand-dev --no-install-recommends \
        libmemcached-dev \
        libzip-dev
RUN pecl install imagick \
    && pecl install memcached \
    && docker-php-ext-enable imagick \
    && docker-php-ext-enable memcached \
    && docker-php-ext-install -j$(nproc) mbstring mysqli pdo_mysql pdo_pgsql zip \
    && docker-php-ext-configure zip \
    && docker-php-ext-install gd \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install -j$(nproc) imap \
    && docker-php-ext-install xsl \
    && docker-php-ext-install opcache \
    && docker-php-ext-enable opcache

RUN apt-get clean \
    && apt-get autoclean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ADD php-opcache.ini /usr/local/etc/php/conf.d/zz-nextcloud-opcache.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get update

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

WORKDIR /var/www
COPY --chown=www-data:www-data . .

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
