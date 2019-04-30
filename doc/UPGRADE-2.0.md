# Upgrading Instructions

## Introduction

This text is a tasklist for migrating standlone installations from oasis to artemis
release aimed to Irontec members. There are lots of keypoints not present in the
following text that may be required in order to completely migrate an existing installation,
so this should not be used for any production environment without expert supervision.

## Prerequisites

Upgrade your installation to your latest release version. All database and packages
changes assume latest release changes have already been applied.


## Database migration

There are more than 150 database migrations from previous release, so It's highly
recommended to test them before migration. Install a Standalone version of Artemis
and replace database contents with an Oasis dump. Then, apply all migrations with:

```
cd /opt/irontec/ivozprovider/schema
bin/console doctrine:migrations:migrate -n
```

This will take from minutes to hours depending on the CDR tables size. If no error
arises, then migrations will be executed properly.


## Debian package configuration

### Prepare APT sources for Debian Stretch

Add following contents into /etc/apt/sources.list.d/debian.list

```
# Debian Stretch official repositories
deb http://ftp.fi.debian.org/debian stretch main contrib non-free
deb http://ftp.fi.debian.org/debian stretch-updates main contrib non-free
deb http://security.debian.org/ stretch/updates main
deb http://ftp.debian.org/debian stretch-backports main contrib non-free
```

## Prepare APT sources for IvozProvider Artemis

Add following contents into /etc/apt/sources.list.d/ivozprovider.list

```
# Irontec IvozProvider artemis repository
deb http://packages.irontec.com/debian artemis main extra
deb http://packages.irontec.com/debian tayler main
```

## Upgrade your system from Debian 8 to Debian 9

    apt-get update
    apt-get dist-upgrade

## Storage updates

Some storage paths have changes, be sure to run following scripts to update
storage file contents


    /bin/bash /opt/irontec/ivozprovider/scripts/FSOBrandMusicOnHold.sh

    /bin/bash /opt/irontec/ivozprovider/scripts/FSObase2index.sh \
        storage/ivozprovider_model_recordings.recordedfile

    /bin/bash /opt/irontec/ivozprovider/scripts/FSObase2index.sh \
        storage/ivozprovider_model_locutions.encodedfile

    /bin/mv /opt/irontec/ivozprovider/storage/ivozprovider_model_invoices.pdffile \
        /opt/irontec/ivozprovider/storage/ivozprovider_model_invoice.pdf


### Invoice templates

Invoices template variables have changed, so they require manual update. Default templates have also
been updated to make it easier to replace default oasis templates.


### Load CGRateS data

Artemis uses CGRateS as billing engine, so all migrated data must be present in redis.

Use following script to load all brands data to redis after database changes.

```
/usr/bin/cgrates-reload
```

