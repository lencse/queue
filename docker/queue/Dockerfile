FROM php:7.2-fpm

RUN docker-php-ext-install bcmath
RUN docker-php-ext-install sockets

ADD https://github.com/ufoscout/docker-compose-wait/releases/download/2.5.0/wait /usr/local/bin/wait
RUN chmod +x /usr/local/bin/wait

CMD wait && /app/queue/queue.php
