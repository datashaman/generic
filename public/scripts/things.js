$(function() {
    var client = new $.es.Client();

    $('[data-index]').each(function () {
        var $this = $(this),
            data = $this.data(),
            columns = $this.find('thead th').map(function () {
                return {
                    data: data.data
                };
            }).get(),
            url = 'http://localhost:9200/' + data.index;

            if (data.type) {
                url += '/' + data.type;
            }

            url += '/_search';

        $this.dataTable({
            serverSide: true,
            ajax: {
                url: url,
                data: function (data, settings) {
                    var params = {
                        from: data.start,
                        size: data.length
                    };

                    if (data.search.value) {
                        params.q = data.search.value;
                    }

                    if (data.order) {
                        var order = data.order[0];
                        params.sort = data.columns[order.column].data + '_raw:' + order.dir;
                    }

                    return params;
                },

                dataSrc: function (data) {
                    data.recordsFiltered = data.recordsTotal = data.hits.total;

                    var hits = data.hits.hits.map(function(hit) {
                        var thing = hit._source;
                        thing.DT_RowID = hit._id;
                        return thing;
                    });

                    return hits;
                }
            },
            columns: columns
        });
    });
});
