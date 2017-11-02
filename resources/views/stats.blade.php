@extends('layouts.app')

@section('content')
    <div class="container">
        <h2> aaa</h2>
        <h3>
            <span class="label label-default"> Short URL:</span>
            {{--<img src="{{asset('images/beaconzone100transparent-114x128.png')}}">--}}
            <a href=""> {{"https://cms/".$link->url}}</a>
        </h3>
        <h3>
            <span class="label label-default"> Short URL:</span>
            {{--<img src="{{asset('images/beaconzone100transparent-114x128.png')}}">--}}
            <a href="{{ route('link.show', $link->id) }}">{{ "http://localhost/cms/".$link->url."/index.html" }}</a>
        </h3>

        <div id="tab">
            <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href="#1a" data-toggle="tab" style="color:#337ab7"><h2> Traffic statistics </h2> </a></li>
                <li role="presentation"><a href="#2a" data-toggle="tab" style="color:#337ab7"><h2>Traffic location</h2></a></li>
                <li role="presentation"><a href="#3a" data-toggle="tab" style="color:#337ab7"><h2>Traffic sources</h2></a></li>
            </ul>

            <div class="tab-content clearfix">
                <div class="tab-pane active" id="1a">
                    <h2>Traffic statistics</h2>
                    <div id="tab" class="col-md-6">
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="active"><a href="#4b" data-toggle="tab">All time</a></li>
                        </ul>
                        <div class="tab-content clearfix">
                            <div class="tab-pane active " id="4b">
                                <div id="chartdiv1" style="width: 100%; height: 500px"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Historical click count</h3>
                                <p>Short URL created on {{date_format($link->created_at, 'g:ia \o\n l jS F Y')}}</p>
                                <ul class="nav nav-pills nav-stacked" id="historical_clicks">
                                    <li role="presentation" class="disabled active">
                                        <a data-toggle="pill">
                                            <span class="historical_link" id="lasthour" name="lasthour">Last 24 hours</span>
                                            <span class="historical_link">{{$first}}
                                            @if($first > 1)
                                                hits
                                             @else
                                                hit
                                            @endif
                                            </span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="disabled ">
                                        <a  data-toggle="pill">
                                            <span class="historical_link">Last 7 days
                                                @if($first > 1)
                                                    hits
                                                @else
                                                    hit
                                                @endif
                                            </span>
                                            <span class="historical_link">{{$second}}
                                                @if($first > 1)
                                                    hits
                                                @else
                                                    hit
                                                @endif

                                            </span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="disabled ">
                                        <a  data-toggle="pill">
                                            <span class="historical_link">Last 30 days</span>
                                            <span class="historical_link">{{$third}}
                                                @if($first > 1)
                                                    hits
                                                @else
                                                    hit
                                                @endif

                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <h3>Best day</h3>
                                <p><strong>4</strong> hits on September 7, 2017 <a>Click for more details</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="2a">
                 <h2>Traffic location</h2>
                <div class="row">
                    <div class="col-md-6">
                        <h3>Top 5 countries</h3>
                        <div id="chartdiv" style="width: 100%; height: 500px; margin-left: -50px"></div>
                    </div>
                    <div class="col-md-6">
                        <h3>Overall Traffic</h3>
                        <div id="regions_div" style="width: 900px; height: 500px;"></div>
                    </div>
                </div>
                </div>

                <div class="tab-pane" id="3a"></div>
            </div>
        </div>
    </div>
@endsection

@section('prescripts')
    <script src="{{ asset('admin/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('admin/js/plugins/forms/selects/select2.min.js')}}"></script>

@endsection

@section('postscripts')
    <script src="{{ asset('admin/js/pages/datatables_basic.js')}}"></script>
@endsection



<script>

    document.addEventListener('DOMContentLoaded', function() {
        var info = {
            "type": "pie",
            "theme": "light",
            "dataProvider": "",
            "valueField": "value",
            "titleField": "country",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 30
        };
        var js_data = '<?php
            if($results )
                echo json_encode($results); ?>';
        var results = JSON.parse(js_data );
        var country = [];
        results.forEach(function(element){
            country.push(element);
        });

        info.dataProvider = country;
        var chart = AmCharts.makeChart( "chartdiv",  info);

        google.charts.load('current', {
            'packages':['geochart'],
            // Note: you will need to get a mapsApiKey for your project.
            // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
            'mapsApiKey': 'AIzaSyB2Z33-rI6XOFyD0DLOYRqD2Cdu9KX8hNc'
        });
        google.charts.setOnLoadCallback(drawRegionsMap);
        var gmap = [ ['Country', 'Popularity']];
        results.forEach(function(element){
            gmap.push([element.country, element.value]);
        });
        function drawRegionsMap() {
            var data = google.visualization.arrayToDataTable(gmap);

            var options = {};

            var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

            chart.draw(data, options);
        }
        var chart_data = '<?php
            if($visitors )
                echo json_encode($visitors); ?>';
        chart_data = JSON.parse(chart_data );
        var data = new Array();
        for (var key in chart_data) {
            // skip loop if the property is from prototype
            if (!chart_data.hasOwnProperty(key)) continue;
            var obj = {
                "date": key,
                "value": chart_data[key].length
            };
            data.push(obj);
        }


        var chart = AmCharts.makeChart("chartdiv1", {
            "type": "serial",
            "theme": "light",
            "marginRight": 40,
            "marginLeft": 40,
            "autoMarginOffset": 20,
            "mouseWheelZoomEnabled":true,
            "dataDateFormat": "YYYY-MM-DD",
            "valueAxes": [{
                "id": "v1",
                "axisAlpha": 0,
                "position": "left",
                "ignoreAxisWidth":true
            }],
            "balloon": {
                "borderThickness": 1,
                "shadowAlpha": 0
            },
            "graphs": [{
                "id": "g1",
                "balloon":{
                    "drop":true,
                    "adjustBorderColor":false,
                    "color":"#ffffff"
                },
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "hideBulletsCount": 50,
                "lineThickness": 2,
                "title": "red line",
                "useLineColorForBulletBorder": true,
                "valueField": "value",
                "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
            }],
            "chartScrollbar": {
                "graph": "g1",
                "oppositeAxis":false,
                "offset":30,
                "scrollbarHeight": 80,
                "backgroundAlpha": 0,
                "selectedBackgroundAlpha": 0.1,
                "selectedBackgroundColor": "#888888",
                "graphFillAlpha": 0,
                "graphLineAlpha": 0.5,
                "selectedGraphFillAlpha": 0,
                "selectedGraphLineAlpha": 1,
                "autoGridCount":true,
                "color":"#AAAAAA"
            },
            "chartCursor": {
                "pan": true,
                "valueLineEnabled": true,
                "valueLineBalloonEnabled": true,
                "cursorAlpha":1,
                "cursorColor":"#258cbb",
                "limitToGraph":"g1",
                "valueLineAlpha":0.2,
                "valueZoomable":true
            },
            "valueScrollbar":{
                "oppositeAxis":false,
                "offset":50,
                "scrollbarHeight":10
            },
            "categoryField": "date",
            "categoryAxis": {
                "parseDates": true,
                "dashLength": 1,
                "minorGridEnabled": true
            },
            "export": {
                "enabled": true
            },
            "dataProvider": data
        });


    });


</script>