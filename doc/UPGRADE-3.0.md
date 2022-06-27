# Upgrading Instructions

## Introduction

This text is a task-list for migrating standlone installations from Artemis (2.X) to Halliday
release (3.X). Although it's possible to upgrade directly an existing installation of Artemis
to the new release, the Debian base system will jump from 9 to 11, so errors will appear during
the upgrade.

** If you want to avoid fixing package conflicts during upgrade, we highly recommend to create
a new fresh installation of IvozProvider Halliday and load an existing database dump from previous
release.**

## Prerequisites

Upgrade your installation to your latest available version (currently 2.21.0). This will ensure
all database migrations are applied and the schema is up-to-date. This is required because Halliday
migrations assume that schema status.

Do a fresh IvozProvider halliday install from one of available methods.

https://irontec.github.io/ivozprovider/en/artemis/basic_concepts/installation/debian_install.html


## Database migration

Create a database dump for your existing artemis (2.x) migration:

```
mysqldump -u root -p ivozprovider > /path/to/ivozprovider-artemis.sql
```

Move the database dump to a new halliday environment and reset its database

Above commands will **DELETE** existing halliday database and create a new one from artemis data,
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

### Prepare APT sources for Debian Stretch

Add following contents into /etc/apt/sources.list.d/debian.list

```
# Debian Bullseye official repositories
deb http://ftp.debian.org/debian bullseye main contrib non-free
deb http://ftp.debian.org/debian bullseye-updates main contrib non-free
deb http://ftp.debian.org/debian bullseye-backports main contrib non-free
deb http://security.debian.org/debian-security bullseye-security main
```

## Prepare APT sources for IvozProvider Halliday

Add following contents into /etc/apt/sources.list.d/ivozprovider.list

```
# Irontec IvozProvider halliday repository
deb http://packages.irontec.com/debian halliday main extra
deb http://packages.irontec.com/debian tayler main
```

## Update your installation to latest available version

    apt-get update
    apt-get upgrade

## Storage updates

Since 3.0, voicemail messages are stored both in storage and a database table. In order to load
existing voicemails into database, use following script.

    /opt/irontec/ivozprovider/scripts/FSOVoicemailMessages.py

This will load ast_voicemail_messages table. A scheduler will parse its contents to populate
VoicemailMessages table. If you want to run the scheduler manually, run:

    /opt/irontec/ivozprovider/microservices/scheduler/bin/run-voicemail-messages

### Load CGRateS data

Halliday uses CGRateS as billing engine, so all migrated data must be present in redis.

Use following script to load all brands data to redis after database changes.

```
/usr/bin/cgrates-reload
```

