FROM debian:stretch

RUN apt-get update && apt-get install -y \
    nginx

ADD nginx.conf /etc/nginx/

ADD symfony.conf /etc/nginx/sites-available/
#ADD default.conf /etc/nginx/sites-available/
#ADD php-generic.conf /etc/nginx/sites-available/

RUN ln -s /etc/nginx/sites-available/symfony.conf /etc/nginx/sites-enabled
#RUN ln -s /etc/nginx/sites-available/default.conf /etc/nginx/sites-enabled
#RUN ln -s /etc/nginx/sites-available/php-generic.conf /etc/nginx/sites-enabled/php-generic

RUN rm /etc/nginx/sites-enabled/default

RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf


RUN usermod -u 1000 www-data

CMD ["nginx"]

EXPOSE 80
#EXPOSE 443 #HTTPS