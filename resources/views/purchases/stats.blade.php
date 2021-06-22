@extends('html')

@section('content')
    <div id="container">
        <div id="stats">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        ['Work',     11],
                        ['Eat',      2],
                        ['Commute',  2],
                        ['Watch TV', 2],
                        ['Sleep',    7]
                    ]);

                    var options = {
                        title: 'My Daily Activities'
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                    chart.draw(data, options);

                    google.visualization.events.addListener(chart, 'click', function(e) {
                        var selection;
                        console.log('click');
                        if (e.targetID) {
                            selection = e.targetID.split('#');
                            if (selection[0].indexOf('vAxis') > -1) {
                                console.log('label clicked = ' + data.getValue(parseInt(selection[selection.length - 1]), parseInt(selection[1])));
                            }
                        }
                    });
                }
            </script>
            <div id="piechart" style="width: 100%; height: 500px;"></div>

        </div>
    </div>
@stop
