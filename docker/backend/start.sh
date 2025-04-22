#!/bin/bash

# Install dependencies
composer config --global repo.packagist composer https://packagist.org
pushd library && composer install --no-interaction --prefer-dist && popd

for API in platform brand client user; do
    pushd web/rest/$API
        composer install --no-interaction
        sudo chmod 777 -R var
        sudo setfacl -dR -m u:docker:rwX -m u:www-data:rwX -m u:root:rwX var
        sudo setfacl  -R -m u:docker:rwX -m u:www-data:rwX -m u:root:rwX var
        rm -rf var/cache/*
        bin/console cache:warmup &
    popd
done

# Generate JWT keys if required
if [ ! -f storage/jwt/private.pem ]; then
    mkdir -p storage
    web/rest/platform/bin/generate-keys --initial
fi

# Ensure migrations are up to date
pushd schema && composer install --no-interaction && popd
schema/bin/console doctrine:migrations:migrate -n

## Services
sudo service apache2 start

# Run FPM service
sudo /usr/sbin/php-fpm8.2 --fpm-config /etc/php/8.2/fpm/php-fpm.conf --nodaemonize --force-stderr
