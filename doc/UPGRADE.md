# Upgrade

IvozProvider uses Debian APT packages for its installation.

Upgrades of installed packages can be obtained from Irontec public repository. Instructions for configuring APT repositories can be found in [documentation](https://irontec.github.io/ivozprovider/en/installation/debian_install.html#apt-repository-configuration).

For upgrading your installation, simply update the local package cache:
```
apt-get update
```

Upgrade your installed ivozprovider-packages:
```
apt install $(dpkg --get-selections | grep ivozprovider | cut -f1)
```

Note: Using the previous command instead of tradicional `apt-get upgrade` will warranty new package depencencies to be pulled for installation.

## Specific version upgrade

We strive to make each minor release compatible with the previous one, but this is not always is possible. Read carefully release notes: if any manual action is required after the upgrade, we will try to provide upgrading instructions documments.

## Release upgrade

Upgrading between mayor releases (p.e. from 1.5.0 to 2.1.0) will be by default impossible unless specific instructions are provided. This allows us to make big changes to the codebase without taking into account already existing installations.
