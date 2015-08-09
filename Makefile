HOST = http://localhost:9200
INDEX = generic
INDEX_URL = $(HOST)/$(INDEX)

index-create:
	curl -XPOST $(INDEX_URL)

index-import:
	curl -XPUT $(INDEX_URL)/menu/main -d@database/indices/menu-main.json
	php artisan import-things database/indices/things.json
