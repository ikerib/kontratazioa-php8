#!/bin/bash

php /usr/src/app/bin/console fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json
php /usr/src/app/bin/console ckeditor:install
php /usr/src/app/bin/console assets:install --symlink public
