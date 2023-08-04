FROM richarvey/nginx-php-fpm:3.1.6

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV local
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

ENV MAIL_MAILER smtp
ENV MAIL_HOST mailpit
ENV MAIL_PORT 1025
ENV MAIL_USERNAME null
ENV MAIL_PASSWORD null
ENV MAIL_ENCRYPTION null
ENV MAIL_FROM_ADDRESS "hello@example.com"
ENV MAIL_FROM_NAME booksapp

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
