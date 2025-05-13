<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Flood Data Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background: #f4f6f8;
            color: #333;
        }
        h1 {
            color: #0077cc;
        }
        label {
            display: block;
            margin: 8px 0 4px;
            font-weight: 600;
        }
        input, select, button {
            padding: 8px;
            font-size: 1rem;
            margin-bottom: 12px;
            width: 100%;
            max-width: 300px;
            border: 1.5px solid #0077cc;
            border-radius: 5px;
        }
        button {
            background-color: #0077cc;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: 700;
        }
        button:hover {
            background-color: #005fa3;
        }
        #map {
            height: 1920px;
            width: 1080px;
            max-width: 1080px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.15);
            margin-top: 20px;
        }
        @media (max-width: 400px) {
            input, select, button {
                max-width: 100%;
            }
            body {
                margin: 10px;
            }
            #map {
                height: 600px;
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

    <h1>Flood Data Map</h1>

    <label for="wilayahInput">Wilayah</label>
    <input type="text" id="wilayahInput" placeholder="Enter wilayah (e.g. Bandung)" />

    <label for="yearInput">Year</label>
    <input type="number" id="yearInput" placeholder="Enter year (e.g. 2025)" />

    <label for="monthInput">Month</label>
    <select id="monthInput">
      <option value="" disabled selected>Select month</option>
      <option value="januari">Januari</option>
      <option value="februari">Februari</option>
      <option value="maret">Maret</option>
      <option value="april">April</option>
      <option value="mei">Mei</option>
      <option value="juni">Juni</option>
      <option value="juli">Juli</option>
      <option value="agustus">Agustus</option>
      <option value="september">September</option>
      <option value="oktober">Oktober</option>
      <option value="november">November</option>
      <option value="desember">Desember</option>
    </select>

    <button id="searchButton">Search Flood Data</button>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/maps.js') }}"></script>
    <script src="{{ asset('js/data.js') }}"></script>
    
</body>
</html>