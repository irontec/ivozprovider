# Upgrading Instructions

## Introduction

This text is a tasklist for migrating IvozProvider installations from artemis 2.15 to 2.16.

## Prerequisites

### Unique administrator names

As of IvozProvider 2.16 administrator usernames are unique across the entire platform. 
In order to be able to apply database migrations successfully you must ensure that there are
no duplicated usernames in the database. The query below should return empty response before you upgrade to 2.16:

`mysql> select username, count(*) as num from Administrators group by username HAVING num > 1;`

### Unique MAC addresses

As of IvozProvider 2.16 terminal MAC addresses are unique across the entire platform. 
In order to be able to apply database migrations successfully you must ensure that there are
no duplicated mac addresses in the database. The query below should return empty response before you upgrade to 2.16:

`mysql> select mac, count(*) as num from Terminals group by mac HAVING num > 1;`
