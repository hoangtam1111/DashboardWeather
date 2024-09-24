<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather Dashboard</title>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .background-color{
            background-color: #d3e7fd;
        }
        .primary-color {
            background-color:#0d6bd6;
            color: white;
        }
        .secondary-color {
            background-color: grey;
            color: white;
        }
        .btn-submit:hover{
            color: #0d6bd6;
            border: 1px solid #0d6bd6;
            transition: 0.5;
        }
        .btn-curent:hover{
            color: gray;
            border: 1px solid gray;
            transition: 0.5;
        }
         .separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 10px 0;
        }
        .line {
            flex: 1;
            height: 1px;
            background-color: lightgray;
        }
        .text {
            margin: 0 10px;
            color: gray;
        }
    </style>
</head>
<body>
    <div class="container m">
        <div class="row background-color align-items-start" >
            <p class="text-center primary-color p-2 fw-bold" style="height: 44px">Weather Dashboard</p>
            <div class="col-4 ">
                <form action="{{ route('post-submit') }}" method="post">
                    <label for="city" class="form-label fw-bold">Enter a City Name</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" placeholder="E.g., Newyork, London, Tokyo">
                    @error('city')
                        <div class="text-danger pt-1">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="primary-color btn w-100 mt-2 btn-submit">Search</button>
                    <div class="separator">
                        <div class="line"></div>
                        <span class="text">or</span>
                        <div class="line"></div>
                    </div>
                    @csrf
                    <button type="submit" class="btn secondary-color w-100 btn-curent">Use Curent Location</button>
                </form>
            </div>
            <div class="col-8">
                <div class="primary-color p-4 rounded">
                    <div class="d-flex justify-content-between">
                        <div class="location">
                            <h4>{{ $city['name'] }} ({{ $city['weather'][0]['date'] }})</h4>
                            <p>Temprature: {{ $city['weather'][0]['temp'] }}°C</p>
                            <p>Wind {{ $city['weather'][0]['wind'] }} M/S</p>
                            <p>Humidity: {{ $city['weather'][0]['humidity'] }}%</p>
                        </div>
                        <div class="weather">
                            <img src="{{ $city['weather'][0]['photo'] }}" alt="" style="width: 100px">
                            <p>{{ $city['weather'][0]['text'] }}</p>
                        </div>
                    </div>
                </div>
                <h3 class="pt-2">4-Day Forecast</h3>
                <div class="row">
                    @for($i = 1; $i <= 4; $i++)
                        <div class="col-3 secondary-color m-1 p-2 rounded" style="width: 23%">
                            <div>({{ $city['weather'][$i]['date'] }})</div>
                            <img src="{{ $city['weather'][$i]['photo'] }}" alt="" width="50px">
                            <p>Temp: {{ $city['weather'][$i]['temp'] }}°C</p>
                            <p>Wind: {{ $city['weather'][$i]['wind'] }} M/S</p>
                            <p>Humidity: {{ $city['weather'][$i]['humidity'] }}%</p>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    {{-- key:

    4f7cd476b76b4b1b89d150530242009 --}}
</body>
</html>
