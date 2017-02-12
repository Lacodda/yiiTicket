FROM mysql:latest

MAINTAINER Lahtachev <lahtachev@gmail.com>

WORKDIR /var/www/backup

ADD my.cnf /etc/mysql/my.cnf
ADD conf.d/my.cnf /etc/mysql/conf.d/my.cnf

CMD ["mysqld"]

EXPOSE 3306