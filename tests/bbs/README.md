# BBS SIP Tests

Files in this directory are used to test IvozProvider SIP behaviour by simulating
calls between multiple users using [Black Box SIP](https://github.com/irontec/bbs)

This tests are extremely superficial and they should be couple with
traditional [SIPP](https://github.com/SIPp/sipp) tests.

## Environment data

In order to use the tests provided an extra file with environment data is required.

This file is used to configure:

 - Set user names and credentials
 - Set SIP users server domain

You can check _environment.yaml_ as example to create enviroment file. Tests assume that the required data used is already existing in the testing enviroment. You can pre-feed this data using rest tests if required.

## Running tests

Provided tests are generated to run with _bbs_ command line tool.
Results can be exported in JUnit XML format for later analysis.

```
bbs -vvv -c 000-scenario.yaml -e environment.yaml -o results.xml
```

## Updating tests

Test files are in YAML format and can contain multiples scenarios
although it's recommended to split them for better results analysis.


