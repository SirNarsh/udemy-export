FROM php:7.4-cli
RUN apt-get update && apt-get install -y \
  zip \
  git \
  libzip-dev \
  libpng-dev \
  && rm -rf /var/lib/apt/lists/*


RUN docker-php-ext-install \
    gd \
    zip

RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN chmod a+x /usr/local/bin/composer

ADD . /udemy-export

WORKDIR /udemy-export

RUN composer install --no-plugins --no-scripts --no-interaction --no-ansi --no-dev

VOLUME "/out"

ENTRYPOINT ["php", "main.php"]