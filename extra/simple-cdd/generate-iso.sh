#!/bin/bash
ARCH=$1
echo Building ISO Image for $ARCH

# Add IvozProvider repositories
echo deb http://packages.irontec.com/debian artemis main extra | sudo tee -a /etc/apt/sources.list
echo deb http://packages.irontec.com/debian tayler main extra  | sudo tee -a /etc/apt/sources.list
wget http://packages.irontec.com/public.key -q -O - | sudo apt-key add -

# Update apt-cache
sudo dpkg --add-architecture $ARCH
sudo apt-get update

# Set required architecture for binary packages
sed -i "s/#ARCH#/$ARCH/g" package.list

# Download ivozprovider packages for given rlease
pushd local
cat ../package.list | xargs apt-get download -t artemis
popd

# Generate iso file
ARCH=$ARCH build-simple-cdd --force-root --conf simple-cdd.conf --verbose --force-preseed --dist stretch
