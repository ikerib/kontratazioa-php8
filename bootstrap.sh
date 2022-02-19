#! /bin/bash
cd /usr/src/app
composer install
php bin/console fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json
php bin/console ckeditor:install
php bin/console assets:install --symlink public
