#!/bin/bash

pushd /opt/irontec/ivozprovider/library
    composer install $*
popd

pushd /opt/irontec/ivozprovider/asterisk/agi
    composer install $*
popd

pushd /opt/irontec/ivozprovider/microservices/recordings
    composer install $*
popd

pushd /opt/irontec/ivozprovider/microservices/workers
    composer install $*
popd

pushd /opt/irontec/ivozprovider/microservices/balances
    composer install $*
popd

pushd /opt/irontec/ivozprovider/scheme
    composer install $*
popd

pushd /opt/irontec/ivozprovider/web/rest
    composer install $*
popd
