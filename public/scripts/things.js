$(function() {
    var aggs = {};
    var client = new $.es.Client();

    $('div[data-index]').each(function () {
        var $this = $(this);
        $this.find('div[data-id]').each(function () {
            aggs[$(this).data('id')] = $(this).data('definition');
        });
    });

    $('table[data-index]').each(function () {
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
                method: 'POST',
                url: url,
                contentType: 'application/json',
                data: function (data, settings) {
                    var params = {
                        from: data.start,
                        size: data.length
                    };

                    if (data.search.value) {
                        params.query = {
                            query_string: {
                                query: data.search.value
                            }
                        };
                    }

                    params.aggs = aggs;

                    if (data.order) {
                        params.sort = [];
                        data.order.forEach(function (order) {
                            var column = data.columns[order.column].data;
                            column += '.raw';
                            var sort = {};
                            sort[column] = order.dir
                            params.sort.push(sort);
                        });
                    }

                    return JSON.stringify(params);
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
