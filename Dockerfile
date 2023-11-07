FROM php:7.4-apache
 
RUN a2enmod rewrite
 
RUN apt-get update \
  && apt-get install -y libzip-dev git wget libonig-dev --no-install-recommends \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN apt-get update; \
    apt-get install -y libpq5 libpq-dev; \
    docker-php-ext-install pdo pdo_pgsql; \
    apt-get autoremove --purge -y libpq-dev; \
    apt-get clean ; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
    
RUN docker-php-ext-install mbstring pdo mysqli pdo_mysql zip bcmath;
 
RUN wget https://getcomposer.org/download/2.0.9/composer.phar \
    && mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer
 
COPY apache.conf /etc/apache2/sites-enabled/000-default.conf
COPY . /var/www
 
WORKDIR /var/www
 
RUN composer install 
RUN composer dump-autoload 
# RUN php bin/console doctrine:migrations:migrate

CMD ["apache2-foreground"]
