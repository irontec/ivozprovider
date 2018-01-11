#!/bin/bash

php ../web/rest/bin/console cache:clear -e prod
php ../web/rest/bin/console cache:clear -e dev --no-warmup
php ../web/rest/bin/console api:swagger:export > web/swagger.json
php ../scheme/bin/console cache:clear -e prod
php ../scheme/bin/console cache:clear -e dev --no-warmup
