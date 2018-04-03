#!/bin/bash

pushd /opt/irontec/ivozprovider/library
    rm -fr composer.lock vendor
    composer install $*
popd

pushd /opt/irontec/ivozprovider/asterisk/agi
    rm -fr composer.lock vendor
    composer install $*
popd

pushd /opt/irontec/ivozprovider/microservices/recordings
    rm -fr composer.lock vendor
    composer install $*
popd

pushd /opt/irontec/ivozprovider/microservices/workers
    rm -fr composer.lock vendor
    composer install $*
popd

pushd /opt/irontec/ivozprovider/microservices/balances
    rm -fr composer.lock vendor
    composer install $*
popd

pushd /opt/irontec/ivozprovider/scheme
    rm -fr composer.lock vendor
    composer install $*
popd

pushd /opt/irontec/ivozprovider/web/rest
    rm -fr composer.lock vendor
    composer install $*
popd
