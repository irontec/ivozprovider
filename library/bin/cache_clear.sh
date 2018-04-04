#!/bin/bash

pushd /opt/irontec/ivozprovider/scheme
    php bin/console cache:clear -e prod
    php bin/console cache:clear -e dev --no-warmup
popd

pushd /opt/irontec/ivozprovider/web/rest
    php bin/console cache:clear -e dev --no-warmup
    php bin/console cache:clear -e prod
    php bin/console api:swagger:export > web/swagger.json
popd

pushd /opt/irontec/ivozprovider/asterisk/agi
    php bin/console cache:clear -e prod
    php bin/console cache:clear -e dev --no-warmup
popd

pushd /opt/irontec/ivozprovider/microservices/recordings
    php bin/console cache:clear -e prod
    php bin/console cache:clear -e dev --no-warmup
popd

pushd /opt/irontec/ivozprovider/microservices/workers
    php bin/console cache:clear -e prod
    php bin/console cache:clear -e dev --no-warmup
popd

pushd /opt/irontec/ivozprovider/microservices/balances
    php bin/console cache:clear -e prod
    php bin/console cache:clear -e dev --no-warmup
popd