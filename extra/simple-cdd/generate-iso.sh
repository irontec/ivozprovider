#!/bin/bash
echo Building ISO Image for amd64

# Add IvozProvider repositories
echo deb http://packages.irontec.com/debian tempest main extra | sudo tee -a /etc/apt/sources.list
echo deb http://packages.irontec.com/debian tayler main extra  | sudo tee -a /etc/apt/sources.list
sudo wget http://packages.irontec.com/public.key -q -O /etc/apt/trusted.gpg.d/irontec-debian-repository.asc

# Update apt-cache
sudo apt-get update

# Download ivozprovider packages for given release
pushd local
cat ../package.list | xargs apt-get download -t tempest
popd

# Generate iso file
build-simple-cdd --dvd --force-root --conf simple-cdd.conf --verbose --force-preseed --dist bookworm
