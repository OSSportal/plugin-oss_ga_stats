<div id="__xe_chart" style="width: 100%; height: 450px" data-progress-type="cover" data-progress-bgcolor="#ffffff"></div>

<script type="text/javascript">
    (function ($, url, chartType, columns, form) {
        $(function () {
            google.charts.setOnLoadCallback(function () {
                if (form) {
                    $(form).submit(function (e) {
                        e.preventDefault();
                        dataLoad($(this).serialize());
                    });
                    $(form).triggerHandler('submit');
                } else {
                    dataLoad();
                }
            });

            var dataLoad = function (data) {
                $.ajax({
                    url: url,
                    type: 'get',
                    data: data,
                    dataType: 'json',
                    context: $('#__xe_chart'),
                    success: function (response) {
                        draw(response);
                    },
                    error: function () {

                    }
                });
            };

            var draw = function (rawData) {
                var rows = buildData(rawData);
                var data = new google.visualization.DataTable();
                for (var i in columns) {
                    data.addColumn(columns[i].type, columns[i].name);
                }
                data.addRows(rows);

                var chart = eval("new google.visualization."+chartType+"(document.getElementById('__xe_chart'))");
                var format = columns[0].format ? {format: columns[0].format} : {};

                chart.draw(data, {
                    pointSize: 5,
                    hAxis: format,
                    vAxis: {format: 'short'},
                    legend: 'none',
                    chartArea: {left:30, top:20, width:'90%',height:'80%'}
                });
            };

            var parseDate = function (strDate) {
                var y = strDate.substr(0, 4),
                    m = strDate.substr(4, 2),
                    d = strDate.substr(6, 2);

                return [y, m, d];
            };

            var buildData = function (rawData) {
                var rows = rawData;
                for (var i = 0; i < rows.length; i++) {
                    var row = [];
                    for (var j = 0; j < columns.length; j++) {
                        console.log(columns);
                        if (columns[j].type === 'date') {
                            var parsed = parseDate(rows[i][j]);
                            row.push(new Date(parsed[0], parseInt(parsed[1]) - 1, parsed[2]));
                        } else if (columns[j].type === 'number') {
                            row.push(parseInt(rows[i][j]));
                        } else {
                            row.push(rows[i][j]);
                        }
                    }
                    rows[i] = row;
                }

                return rows;
            };

        });

    })(jQuery, '{{ $url }}', '{{ $chart }}', eval('{!! json_enc($columns) !!}'), '{{ $form ?: '' }}')
</script>