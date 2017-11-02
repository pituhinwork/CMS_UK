<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CMS') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;subset=latin">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">

    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('cms/bootstrap-material-design-font/css/material.css')}}" >
    <link rel="stylesheet" href="{{asset('cms/tether/tether.min.css')}}" >
    <link rel="stylesheet" href="{{asset('cms/dropdown/css/style.css')}}" >
    <link rel="stylesheet" href="{{asset('cms/animate.css/animate.min.css')}}" >
    {{--<link rel="stylesheet" href="{{asset('cms/theme/css/style.css')}}" >--}}
    <link rel="stylesheet" href="{{asset('cms/mobirise/css/mbr-additional.css')}}" type="text/css" >
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'CMS') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li role="presentation" class="dropdown">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                                    Hello <strong>{{ Auth::user()->name }}</strong>
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>

                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{asset('cms/web/assets/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('cms/tether/tether.min.js')}}"></script>
    <script src="{{asset('cms/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('cms/smooth-scroll/smooth-scroll.js')}}"></script>
    <script src="{{asset('cms/dropdown/js/script.min.js')}}"></script>
    <script src="{{asset('cms/touch-swipe/jquery.touch-swipe.min.js')}}"></script>
    <script src="{{asset('cms/viewport-checker/jquery.viewportchecker.js')}}"></script>
    <script src="{{asset('cms/jarallax/jarallax.js')}}"></script>
    <script src="{{asset('cms/theme/js/script.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Bootstrap Javascript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#my_form").submit(function(){
                var name = document.getElementById("name_table").value;
                var title = document.getElementById("title_table").value;
                var description = document.getElementById("description_table").value;
                var text = $('#text_table').summernote('code');
                var id = document.getElementById("id_table").value;

                document.getElementById("name_table1").value = name;
                document.getElementById("title_table1").value = title;
                document.getElementById("description_table1").value = description;
                document.getElementById("text_table1").value = text;
                document.getElementById("id_table1").value = id;
            });
            var flag = false;
            $('.editbtn').click(function () {
                if(flag == false)
                {
                    var currentTD = $(this).parents('tr');
                    var $tds = currentTD.find("td:nth-child(1)");           // Finds all children <td> elements
                    var name = $tds.text();
                    var $tds = currentTD.find("td:nth-child(2)");           // Finds all children <td> elements
                    var title = $tds.text();
                    var $tds = currentTD.find("td:nth-child(3)");           // Finds all children <td> elements
                    var description = $tds.text();
                    var $tds = currentTD.find("td:nth-child(4)");           // Finds all children <td> elements
                    var text = $tds.text();
                    var $tds = currentTD.find("td:nth-child(5)");           // Finds all children <td> elements
                    var id = $tds.text();


                    var markup = `

                     <tr>
                     <td colspan="4">

                    <div class="form-group">
                    <label for="name">Name</label><br>
                     <input type="text" id="name_table" name="name" value="" class="form-control" size="90"  style="background-color: white" form="my_form"> </div><br>
                     <div class="form-group"><label for="title_table"><strong>Title</strong></label><br><input type="text" id="title_table" name="title" class="form-control" size="90" value="" style="background-color: white" form="my_form"></div><br>
                     <div class="form-group"><label for="description_table"><strong>Description</strong></label><br><input type="text" id="description_table" name="description" class="form-control" size="90" value="" style="background-color: white" form="my_form"></div><br>
                     <input type="hidden" id="text" name="text">
                     <div class="form-group"><label for="text_table"><strong>Web site text or HTML</strong></label><br><div id="text_table" name="text_table">Hi</div></div>
                     <input type="hidden" id="id_table" name="text" form="my_form">

                 </td>
                 <td colspan="1" id="save_cancel_td">
                 <div class="btn-group" role="group" aria-label="...">
                 <button type="submit" class="btn btn-primary ladda-button" value="Save" id="save" title="Save new values" form="my_form">Save</button>
                 <button type="button" value="Cancel" title="Cancel editing" class="btn btn-primary ladda-button" style="letter-spacing: 0px">Cancel</button>
                 </div>
                 </td>
                  </tr>`;


                    currentTD.after(markup);
                    document.getElementById("name_table").value = name;
                    document.getElementById("title_table").value = title;
                    document.getElementById("description_table").value = description;
//                    document.getElementById("text_table").value = text;
                    document.getElementById("id_table").value = id;
                    $('#text_table').summernote();
                    $('#text_table').summernote('code', text);

                    flag = true;


                }

            });
        });
    </script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

    <script src="{{asset('amcharts/amcharts.js')}}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    {{--<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>--}}
    <script src="{{asset('amcharts/pie.js')}}"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

    <!-- Chart code -->

    <script src="https://www.amcharts.com/lib/3/ammap.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldHigh.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/themes/dark.js" type="text/javascript"></script>
    <div id="mapdiv" style="width: 1000px; height: 450px;"></div>


    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script type="text/javascript" src="https://www.amcharts.com/lib/3/themes/none.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
        $( "#add_beacon" ).submit(function() {
            $('#text').val($('#summernote').summernote('code'));
//            alert($('#text').val());
//            alert( "Handler for .submit() called." );
//            event.preventDefault();
        });


    </script>


</body>
</html>
