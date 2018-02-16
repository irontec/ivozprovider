#!/bin/bash
BASEDIR=$(dirname $0)
/usr/bin/php ${BASEDIR}/cliDocs.php -a default/apidoc/index -e development
