FROM alpine:latest

MAINTAINER Lahtachev <lahtachev@gmail.com>

WORKDIR /var/www/site

RUN addgroup www-data && adduser -s /bin/bash -D -G www-data www-data
RUN chown -R www-data:www-data /var/www/site/ && chmod -R 775 /var/www/site

CMD ["true"]