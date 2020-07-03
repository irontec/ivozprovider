# Upgrading Instructions

## Introduction

This text is a tasklist for migrating standlone installations from artemis 2.15 to 2.16.

## Prerequisites

As of Ivoz Provider 2.16 administrator usernames are unique across the entire platform. 
In order to be able to apply database migrations successfully you must ensure that there are
no duplicated usernames in the database. The query below should return empty response before you upgrade Ivoz Provider:

`mysql> select username, count(*) as num from Administrators group by username HAVING num > 1;`
