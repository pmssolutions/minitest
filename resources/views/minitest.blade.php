<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Minitest</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
        <!-- Styles -->
        <style>
            html, body {
                background-color: lightblue;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            #day {
                padding:50px;
            }

            #day h1 {
                color:darkblue;
                font-size:50px;
                padding-top:10px;
                font-weight:bold;
            }

            .today-real1 {
                bottom:-88px;
                font-weight:bold;
                text-align:right;
            }

            .today-real1 .label1 {
                color:white;
                font-size:60px;
            }

            .today-real1 .value1 {
                color:green;
                font-size:28px;
            }

            .today-real1 .value2 {
                color:brown;
                font-size:28px;
            }

            .today-real2 {
                bottom:-180px;
                font-size:28px;
            }

            .today-real2 .label1 {
                color:white;
            }

            .today-real2 .value1 {
                color:green;
                font-weight:bold;
            }

            .today-real2 .value2 {
                color:brown;
            }

            .today-city {
                font-size:28px;
                color:white;
            }

            #wind-day .label{
                font-size:18px;
                font-weight:bold;
                color:darkblue;
            }

            #wind-day .value{
                font-size:18px;
                font-weight:bold;
                color:white;
            }

            .bd-navbar {
                position: sticky;
                top: 0;
                z-index: 10;
            }

            .navbar-dark .navbar-nav .nav-link {
                font-weight:bold;
                color:white;
            }

            .days-max-temp {
                color:brown;
                font-weight:bold;
                font-size:18px;
            }

            .days-min-temp {
                color:darkblue;
                font-weight:bold;
                font-size:18px;
            }

            .card-header {
                padding: .30rem 1.25rem;
                margin-bottom: 0;
                background-color: rgba(0,0,0,.03);
                border-bottom: 1px solid rgba(0,0,0,.125);
            }

            .w_day {
                text-align:center;
                font-size:16px;
                font-weight:bold;
            }
        </style>
    </head>
    <body>
        <header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
            <div class="navbar-nav-scroll col-sm-10">
                <ul class="navbar-nav bd-navbar-nav flex-row">
                    <li class="nav-item">
                        <a class="nav-link" href="/" >Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#selectCity">Select City</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-2">
                <form method="get" action="getbycity">
                    <input type="text" class="form-control form-control-sm" name="city" id="city" placeholder="Search City" required>
                </form>
            </div>
        </header>

        <div class="container-fluid">
            <div id="day" class="row">
                <div class="col">
                    <div id="today" class="row" >
                        <div class="col-sm-5 today-real1">
                            <span class="label1">{{ round($datas['consolidated_weather'][0]['the_temp']) }}&deg;</span><br>
                            <span class="value1">{{ round($datas['consolidated_weather'][0]['max_temp']) }}&deg;</span><span class="today-city">/</span>
                            <span class="value2">{{ round($datas['consolidated_weather'][0]['min_temp']) }}&deg;</span>
                        </div>
                        <div class="col-sm-2" style="text-align:center">
                            <img src="https://www.metaweather.com/static/img/weather/{{ $datas['consolidated_weather'][0]['weather_state_abbr'] }}.svg" style="width:200px">
                        </div>
                        <div class="col-sm-5 today-real2">
                            <span class="label1">RealFeel</span> <span class="value1">{{ round($datas['consolidated_weather'][0]['the_temp']) }}&deg;</span>
                        </div>
                        <div class="col-sm-12" style="text-align:center;">
                            <h1>{{ $datas['consolidated_weather'][0]['weather_state_name'] }}</h1>
                        </div>
                        <div class="col-sm-12" style="text-align:center;">
                            <span class="today-city">{{ $datas['title'].' '.$datas['location_type'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="wind-day" class="row">
                <div class="col-sm-8">
                    <span class="label">Wind</span>
                    <span class="value">{{ round($datas['consolidated_weather'][0]['wind_speed']).'mph'.$datas['consolidated_weather'][0]['wind_direction_compass'] }}</span>&nbsp;
                    <span class="label">Air</span>
                    <span class="value">{{ round($datas['consolidated_weather'][0]['air_pressure']) }}</span>&nbsp;
                    <span class="label">Humidity</span>
                    <span class="value">{{ round($datas['consolidated_weather'][0]['humidity']) }}</span>
                </div>
                <div class="col-sm-4" style="text-align:right">
                    <span class="label">UVindex</span>
                    <span class="value">{{ round($datas['consolidated_weather'][0]['visibility']) }}</span>
                </div>
            </div>
            <div id="days" class="row">
                <div class="col-sm">
                    <div class="card bg-transparent">
                        <div class="card-header w_day">
                            {{ strtoupper(date("l",strtotime($datas['consolidated_weather'][0]['applicable_date']))) }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8"><img src="https://www.metaweather.com/static/img/weather/{{ $datas['consolidated_weather'][0]['weather_state_abbr'] }}.svg" style="width:80px"></div>
                                <div class="col-sm-4">
                                    <span class="days-max-temp">{{ round($datas['consolidated_weather'][0]['max_temp']) }}&deg;</span><br>
                                    <span class="days-min-temp">{{ round($datas['consolidated_weather'][0]['min_temp']) }}&deg;</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card bg-transparent">
                        <div class="card-header w_day">
                            {{ strtoupper(date("l",strtotime($datas['consolidated_weather'][1]['applicable_date']))) }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8"><img src="https://www.metaweather.com/static/img/weather/{{ $datas['consolidated_weather'][1]['weather_state_abbr'] }}.svg" style="width:80px"></div>
                                <div class="col-sm-4">
                                    <span class="days-max-temp">{{ round($datas['consolidated_weather'][1]['max_temp']) }}&deg;</span><br>
                                    <span class="days-min-temp">{{ round($datas['consolidated_weather'][1]['min_temp']) }}&deg;</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card bg-transparent">
                        <div class="card-header w_day">
                            {{ strtoupper(date("l",strtotime($datas['consolidated_weather'][2]['applicable_date']))) }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8"><img src="https://www.metaweather.com/static/img/weather/{{ $datas['consolidated_weather'][2]['weather_state_abbr'] }}.svg" style="width:80px"></div>
                                <div class="col-sm-4">
                                    <span class="days-max-temp">{{ round($datas['consolidated_weather'][2]['max_temp']) }}&deg;</span><br>
                                    <span class="days-min-temp">{{ round($datas['consolidated_weather'][2]['min_temp']) }}&deg;</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card bg-transparent">
                        <div class="card-header w_day">
                            {{ strtoupper(date("l",strtotime($datas['consolidated_weather'][3]['applicable_date']))) }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8"><img src="https://www.metaweather.com/static/img/weather/{{ $datas['consolidated_weather'][3]['weather_state_abbr'] }}.svg" style="width:80px"></div>
                                <div class="col-sm-4">
                                    <span class="days-max-temp">{{ round($datas['consolidated_weather'][3]['max_temp']) }}&deg;</span><br>
                                    <span class="days-min-temp">{{ round($datas['consolidated_weather'][3]['min_temp']) }}&deg;</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card bg-transparent">
                        <div class="card-header w_day">
                            {{ strtoupper(date("l",strtotime($datas['consolidated_weather'][4]['applicable_date']))) }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8"><img src="https://www.metaweather.com/static/img/weather/{{ $datas['consolidated_weather'][4]['weather_state_abbr'] }}.svg" style="width:80px"></div>
                                <div class="col-sm-4">
                                    <span class="days-max-temp">{{ round($datas['consolidated_weather'][4]['max_temp']) }}&deg;</span><br>
                                    <span class="days-min-temp">{{ round($datas['consolidated_weather'][4]['min_temp']) }}&deg;</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="selectCity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-sm" role="document">
                <div class="modal-content">
                    <form method="get" action="getbycity">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">City History</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <select class="form-control" id="exampleFormControlSelect1" name="city" required>
                                    <option value="" selected disabled>Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->city }}">{{ $city->city }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Get Weather</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        
    </body>
</html>
