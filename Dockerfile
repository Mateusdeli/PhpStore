FROM php:7.4-apache

WORKDIR /home/

RUN apt-get update && apt-get install -y

RUN docker-php-ext-install mysqli pdo pdo_mysql
EXPOSE 8000
COPY . /home/

CMD ["php", "-S", "0.0.0.0:8000"]