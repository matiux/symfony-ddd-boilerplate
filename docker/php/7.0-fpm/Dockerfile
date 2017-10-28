FROM debian:stretch

# Php
RUN apt-get update && apt-get install -y software-properties-common  \
      php7.0 php7.0-fpm php7.0-mysql mcrypt php7.0-gd curl \
      php7.0-curl php-redis supervisor \
      php7.0-xdebug \
      php-memcached \
      php-xml \
      php-bcmath \
      php-bz2 \
      php-cli \
      php-curl \
      php-gd \
      php-intl \
      php-imap \
      php-mailparse \
      php-mbstring \
      php-mcrypt \
      php-zip \
      php-sqlite3 \
      git \
      && mkdir /run/php \
      && apt-get remove --purge -y software-properties-common \
      && apt-get autoremove -y \
      && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Composer
RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/local/bin/ \
        && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

#Configuro Xdebug
COPY xdebug.ini /etc/php/7.0/mods-available/xdebug.ini
RUN sed -i "s/xdebug\.remote_host=.*/xdebug\.remote_host="$(/sbin/ip route|awk '/default/ { print $3 }')"/" /etc/php/7.0/mods-available/xdebug.ini
ENV PHP_IDE_CONFIG=serverName=application

RUN sed -i "s/display_errors = Off/display_errors = On/" /etc/php/7.0/fpm/php.ini
RUN sed -i "s/display_errors = Off/display_errors = On/" /etc/php/7.0/cli/php.ini

RUN sed -i -e 's/listen = \/run\/php\/php7.0-fpm.sock/listen = 0.0.0.0:9000/g' /etc/php/7.0/fpm/pool.d/www.conf \
    && sed -i -e 's/;daemonize = yes/daemonize = no/g' /etc/php/7.0/fpm/php-fpm.conf

WORKDIR /var/www/app

#CMD ["/usr/bin/supervisord"]

COPY start-container /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container

CMD ["start-container"]
