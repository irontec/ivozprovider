#!/bin/bash

php ../web/rest/bin/console cache:clear -e prod
php ../web/rest/bin/console cache:clear -e dev --no-warmup
php ../scheme/bin/console cache:clear -e prod
php ../scheme/bin/console cache:clear -e dev --no-warmup
