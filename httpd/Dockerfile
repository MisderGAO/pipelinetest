From httpd:2.4

LABEL maintainer="Ozitem"

#following command only works for debian versions under 9
#RUN echo "Europe/Paris" > /etc/timezone 

RUN ln -fs /usr/share/zoneinfo/Europe/Paris /etc/localtime \
    && dpkg-reconfigure -f noninteractive tzdata

COPY www/ /usr/local/apache2/www/

#RUN chown www-data:www-data /usr/local/apache2/www
#USER www-data
