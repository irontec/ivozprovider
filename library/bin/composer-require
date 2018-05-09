#!/bin/bash

pushd /opt/irontec/ivozprovider/library
    composer require $*
popd

pushd /opt/irontec/ivozprovider/asterisk/agi
    composer require $*
popd

pushd /opt/irontec/ivozprovider/microservices/recordings
    composer require $*
popd

pushd /opt/irontec/ivozprovider/microservices/workers
    composer require $*
popd

pushd /opt/irontec/ivozprovider/microservices/balances
    composer require $*
popd

pushd /opt/irontec/ivozprovider/scheme
    composer require $*
popd

pushd /opt/irontec/ivozprovider/web/rest
    composer require $*
popd
