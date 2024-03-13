# Upgrading Instructions

## Introduction

This text is a task-list for migrating standlone installations from Halliday (3.X) to Tempest
release (4.X). Although it's possible to upgrade directly an existing installation of Halliday
to the new release, the Debian base system will jump from 11 to 12, so errors may appear during
the upgrade.

** If you want to avoid fixing package conflicts during upgrade, we highly recommend creating
a new fresh installation of IvozProvider Tempest and load an existing database dump from previous
release.**

## Prerequisites

Upgrade your installation to your latest available version (currently 3.4.1). This will ensure
all database migrations are applied and the schema is up-to-date. This is required because Tempest
migrations assume that schema status.

Do a fresh IvozProvider tempest install from one of available methods.

https://irontec.github.io/ivozprovider/en/tempest/basic_concepts/installation/debian_install.html


## Database migration

Create a database dump for your existing halliday (3.x) migration:

```
mysqldump -u root -p ivozprovider > /path/to/ivozprovider-halliday.sql
```

Move the database dump to a new tempest environment and reset its database

Above commands will **DELETE** existing tempest database and create a new one from artemis data,
applying all new migrations.

```
cd /opt/irontec/ivozprovider/schema
bin/console doctrine:database:drop --force
bin/console doctrine:database:create
mysql -u root -p ivozprovider < /path/to/ivozprovider-artemis.sql
bin/console doctrine:migrations:migrate -n
```

This will take from minutes to hours depending on the CDR tables size. If no error
arises, then migrations will be executed properly.


## Debian package configuration

Following section assumes you are upgrading the system from latest halliday to tempest.
This is not recommended and package conflicts will arise. It's preferable to do a new
halliday fresh install and migrate database and storage contents.

### Prepare APT sources for Debian Bullseye

Add following contents into /etc/apt/sources.list.d/debian.list

```
# Debian Bookworm official repositories
deb http://ftp.debian.org/debian bookworm main contrib non-free
deb http://ftp.debian.org/debian bookworm-updates main contrib non-free
deb http://ftp.debian.org/debian bookworm-backports main contrib non-free
deb http://security.debian.org/debian-security bookworm-security main
```

## Prepare APT sources for IvozProvider Tempest

Add following contents into /etc/apt/sources.list.d/ivozprovider.list

```
# Irontec IvozProvider tempest repository
deb http://packages.irontec.com/debian tempest main extra
deb http://packages.irontec.com/debian tayler main
```

## Update your installation to latest available version

    apt-get update
    apt-get upgrade

Note: New database configurations assumes percona-server will be used. If you have trouble starting
your database, install latest percona-server-server from tempest repositories.

    apt-get install percona-server-server

### Load CGRateS data

Tempest uses CGRateS as billing engine, so all migrated data must be present in redis.

Use following script to load all brands data to redis after database changes.

```
/usr/bin/cgrates-reload -b all -d
```

