#!/bin/bash
echo Building ISO Image for amd64

# Add IvozProvider repositories
echo deb http://packages.irontec.com/debian halliday main extra | sudo tee -a /etc/apt/sources.list
echo deb http://packages.irontec.com/debian tayler main extra  | sudo tee -a /etc/apt/sources.list
wget http://packages.irontec.com/public.key -q -O - | sudo apt-key add -

# Update apt-cache
sudo apt-get update

# Download ivozprovider packages for given rlease
pushd local
cat ../package.list | xargs apt-get download -t halliday
popd

# Generate iso file
build-simple-cdd --force-root --conf simple-cdd.conf --verbose --force-preseed --dist buster
