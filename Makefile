serve:
	php -S localhost:8000 -t public/ index.php

create-example-db:
	sqlite3 example.db < db/schema.sql
