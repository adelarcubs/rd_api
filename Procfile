release: chmod -R 755 data/ && ./vendor/bin/doctrine orm:schema-tool:update --force && chmod -R 755 data/
web: vendor/bin/heroku-php-apache2 public/
