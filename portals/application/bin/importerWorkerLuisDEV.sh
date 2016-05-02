#!/bin/bash

COUNT=1 \
INTERVAL=2 \
PREFIX=pricing-plans-importer-worker \
APPLICATION_ENV=development \
VERBOSE=1 \
VVERBOSE=0 \
QUEUE=pricesImporter \
APP_INCLUDE=//home/luis/workspace/ivozprovider/portals/application/bin/resque-cli.php \
/usr/bin/php /home/luis/workspace/ivozprovider/portals/library/vendor/chrisboulton/php-resque/resque.php