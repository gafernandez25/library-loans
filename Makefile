
clone-post-actions: install-dependencies dump-autoload chown-storage-apache clear-config link-storage test-database-migrate

pull-post-actions: install-dependencies dump-autoload database-migrate

install-dependencies:
	composer install

dump-autoload:
	composer dump-autoload

chown-storage-apache:
	chown -R www-data:www-data storage/*

clear-config:
	php artisan config:clear

link-storage:
	php artisan storage:link

decrypt-env:
	php artisan env:decrypt --key=$(KEY)

tests-run:
	php artisan test

api-doc-regenerate:
	php artisan l5-swagger:generate

database-migrate:
	php artisan encryptenv:console 'php artisan migrate' $(KEY)

test-database-migrate:
	php artisan migrate --env=testing
