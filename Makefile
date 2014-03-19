serve:
	php -S localhost:8000 -t public/ index.php

prepare:
	mkdir storage

create-example-db: prepare
	sqlite3 storage/example.db < db/schema.sql

install:
	composer install
	bower install
