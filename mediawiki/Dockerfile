FROM lucasbasquerotto/wordpress:composer-1.8.6 AS builder

RUN mkdir /tmp/main \
 && cd /tmp/main \
 && git clone --depth 1 https://github.com/edwardspec/mediawiki-aws-s3-stable-fork.git aws \
 && cd /tmp/main/aws \
 && composer install

FROM mediawiki:1.35.1

USER root

ENV APP_DIR /var/www/html

COPY --from=builder /tmp/main/aws $APP_DIR/extensions/AWS

RUN docker-php-ext-install sockets \
 && docker-php-ext-enable sockets
