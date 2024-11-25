FROM php:8.3-apache

WORKDIR /var/www/soft-svit
COPY ./src/ .

RUN apt-get install && apt-get update -y \
    && docker-php-ext-install pdo_mysql  \
    && apt-get install -y bzip2 libbz2-dev \
    && apt-get install -y libzip-dev \
    && apt-get install -y p7zip \
    && apt-get install -y libsocket++-dev


RUN docker-php-ext-install zip
RUN apt install -y libxml2-dev
RUN docker-php-ext-install bz2
RUN apt install -y libldap2-dev
RUN apt install -y libxml2-dev
RUN apt install -y curl
RUN docker-php-ext-install soap
RUN docker-php-ext-install dom
RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu
RUN docker-php-ext-install ldap
RUN docker-php-ext-install xml
RUN docker-php-ext-install bcmath sockets

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

COPY ./php/apache/soft-svit.conf /etc/apache2/sites-available/soft-svit.conf
RUN a2enmod rewrite && a2ensite soft-svit
RUN service apache2 restart

#RUN chown -R www-data:www-data storage
#CMD php artisan migrate && composer install


