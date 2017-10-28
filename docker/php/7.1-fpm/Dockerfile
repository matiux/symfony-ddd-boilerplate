FROM debian:buster

RUN apt-get update && apt-get install -y software-properties-common  \
      build-essential pkg-config make git g++ gcc \
      libmemcached-dev libmsgpack-dev libmsgpackc2 zlib1g zlib1g-dev \
      vim vim-gtk3 \
      supervisor acl \
      php7.1 php7.1-fpm php7.1-bcmath \
      php7.1-bz2 php7.1-cgi php7.1-cli \
      php7.1-common php7.1-curl php7.1-dev \
      php7.1-imap php7.1-json php7.1-mbstring \
      php7.1-mcrypt php7.1-mysql php7.1-opcache \
      php7.1-readline php7.1-sqlite3 php7.1-xml php7.1-zip \
      && mkdir /run/php \
      && apt-get remove --purge -y software-properties-common \
      && apt-get autoremove -y \
      && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN sed -i "s/display_errors = Off/display_errors = On/" /etc/php/7.1/fpm/php.ini
RUN sed -i "s/display_errors = Off/display_errors = On/" /etc/php/7.1/cli/php.ini

RUN sed -i -e 's/listen = \/run\/php\/php7.1-fpm.sock/listen = 0.0.0.0:9000/g' /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i -e 's/;daemonize = yes/daemonize = no/g' /etc/php/7.1/fpm/php-fpm.conf

RUN sed -i -e 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g' /etc/php/7.1/fpm/php.ini
RUN sed -i -e 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g' /etc/php/7.1/cli/php.ini

# Composer
RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/local/bin/ \
        && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

#Xdebug
RUN cd /root/ && git clone https://github.com/xdebug/xdebug.git && cd xdebug \
   && phpize \
   && ./configure --enable-xdebug \
   && make \
   && mv modules/ /usr/local/xdebug \
   && cd /root \
   && rm -fr xdebug

#Configuro Xdebug
COPY xdebug.ini /etc/php/7.1/mods-available/xdebug.ini
RUN sed -i "s/xdebug\.remote_host=.*/xdebug\.remote_host="$(/sbin/ip route|awk '/default/ { print $3 }')"/" /etc/php/7.1/mods-available/xdebug.ini
ENV PHP_IDE_CONFIG=serverName=application

#RUN ln -s /etc/php/7.1/mods-available/xdebug.ini /etc/php/7.1/cli/conf.d/20-xdebug.ini
#RUN ln -s /etc/php/7.1/mods-available/xdebug.ini /etc/php/7.1/fpm/conf.d/20-xdebug.ini
#RUN sed -i -e 's/xdebug.so/\/usr\/local\/xdebug\/xdebug.so/g' /etc/php/7.1/mods-available/xdebug.ini


#Configuro memcached
RUN cd /root/ && git clone --depth 1 https://github.com/php-memcached-dev/php-memcached.git && cd php-memcached \
   && phpize \
   && ./configure && make \
   && mv modules/ /usr/local/memcached \
   && cd /root \
   && rm -fr php-memcached

#Configuro Phpmemcached
RUN echo "extension=/usr/local/memcached/memcached.so" > /etc/php/7.1/mods-available/memcached.ini
RUN ln -s /etc/php/7.1/mods-available/memcached.ini /etc/php/7.1/cli/conf.d/20-memcached.ini
RUN ln -s /etc/php/7.1/mods-available/memcached.ini /etc/php/7.1/fpm/conf.d/20-memcached.ini





WORKDIR /var/www/app

# CMD ["/usr/bin/supervisord"]

COPY start-container /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container

CMD ["start-container"]
