HOST = http://localhost:9200
INDEX = generic
INDEX_URL = $(HOST)/$(INDEX)

index-create:
	curl -XPOST $(INDEX_URL) -d@database/indices/$(INDEX).json

index-delete:
	curl -XDELETE $(INDEX_URL)

index-import:
	curl -XPUT $(INDEX_URL)/menu/main -d@database/indices/menu-main.json
	php artisan import-things $(INDEX) category database/indices/categories.json
	php artisan import-things $(INDEX) thing database/indices/things.json
	php artisan embed-things database/indices/thing-category.json

index-recreate: index-delete index-create index-import
