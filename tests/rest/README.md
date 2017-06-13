# Rest API Tests

Files in this directory are used to test IvozProvider mappers by creating and
removing objects using the Rest-API.

## Environment data

In order to use the tests provided an extra file with environment data is required.

This file is used to configure:

 - API Rest URL
 - API Rest credentials

You can check _environment.json_ as example to create enviroment file. Basic
Auth headers can be obtained from user and password of any global administrator
in the portal.

## Running tests

Provided tests are generated with postman and they can be runned using its
command line tool _newman_. Results can be exported in JUnit XML format for
later analysis.

It's important to run newman with `-x` flag to ensure the created data will be
deleted even if the tests have failed.


```
newman -Cx -c postman-api-tests.json -e environemnt.json -t results.xml
```

## Updating tests

Editing the provided json file for tests is done with [postman](https://www.getpostman.com/).

In order to easily keep track of changes, it's highly recommended to formati
the json file with some pretty printer. Most editors can do this or you can
use an online formatter.

Current json collection is formated for Postman Collection v1.


