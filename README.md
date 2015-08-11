generic
=======

Experiments with a generic easily-assembled Elasticsearch UI, using:

* Laravel's Lumen
* Bootstrap
* Datatables

It speaks directly to an Elasticsearch instance from the browser, so
you should enable and configure CORS on the Elasticsearch instance in
your config file:

    http.cors.enabled: true

And you should also restrict access to specific origins (it accepts * by default):

    http.cors.allow-origin: *

Check the documentation for how to configure access [here](https://www.elastic.co/guide/en/elasticsearch/reference/current/modules-http.html).
