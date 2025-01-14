#!/bin/bash

# Install common dependencies
cd /opt/irontec/ivozprovider/web/portal
yarn install

# Install portal dependencies
cd /opt/irontec/ivozprovider/web/portal/$1
yarn install

# Run the portal in debug  mode
yarn start