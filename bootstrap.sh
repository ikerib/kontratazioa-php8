#!/bin/bash

php bin/console fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json

php bin/console assets:install --symlink public
