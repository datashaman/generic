generic
=======

Experiments with a generic easily-assembled Elasticsearch UI, using:

* Laravel's Lumen
* Bootstrap
* Datatables

It speaks directly to an Elasticsearch instance from the browser, so
you should enable and configure CORS on the Elasticsearch instance in
your config file:

    http.cors.enabled: false
