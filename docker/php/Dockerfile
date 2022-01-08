FROM matiux/php:fpm-8.0-bullseye-dev

USER root

COPY conf/xdebug-starter.sh /usr/local/bin/xdebug-starter
RUN chmod +x /usr/local/bin/xdebug-starter
RUN /usr/local/bin/xdebug-starter

RUN rm /usr/local/etc/php/conf.d/docker-php-memlimit.ini
ADD conf/php.ini /usr/local/etc/php

RUN /usr/local/bin/composer self-update \
    && mkdir -p /home/utente/.composer/cache \
    && chown -R utente:utente /home/utente/.composer/cache

USER utente

RUN echo 'alias test="./vendor/bin/simple-phpunit"' >> /home/utente/.zshrc \
    && echo 'alias sfcc="rm -Rf var/cache/*"' >> /home/utente/.zshrc \
    && echo 'alias sf="bin/console"' >> /home/utente/.zshrc \
    && echo 'alias memflush="echo \"flush_all\" | nc servicememcached 11211 -q 1"' >> /home/utente/.zshrc

COPY --chown=utente:utente ssh/* /home/utente/.ssh/
COPY --chown=utente:utente git/.gitconfig /home/utente/.gitconfig
RUN  chmod 600 /home/utente/.ssh/id_rsa
