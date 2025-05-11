<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameters from request
        $city = $request->input('kota');
        $month = $request->input('month');
        $year = $request->input('year');

        // Build API URL with parameters
        $apiUrl = 'http://floonder-api.kakashispiritnews.my.id/api/public/gis/flood-point';
        $queryParams = http_build_query([
            'kota' => $city,
            'month' => $month,
            'year' => $year,
            'limit' => 10000
        ]);
        $fullUrl = $apiUrl . '?' . $queryParams;

        // Fetch data from API
        $response = Http::get($fullUrl);
        $apiData = $response->json();

        // Convert API data to markers format
        $markers = [];
        if (isset($apiData['results']['features'])) {
            foreach ($apiData['results']['features'] as $feature) {
                $coordinates = $feature['geometry']['coordinates'];
                $properties = $feature['properties'];

                $markers[] = [
                    'position' => [
                        'lat' => $coordinates[1], // Latitude is the second coordinate
                        'lng' => $coordinates[0]  // Longitude is the first coordinate
                    ],
                    'draggable' => false,
                    'properties' => [
                        'desa' => $properties['desa'],
                        'kecamatan' => $properties['kecamatan'],
                        'wilayah' => $properties['wilayah'],
                        'provinsi' => $properties['provinsi'],
                        'month' => $properties['month'],
                        'year' => $properties['year'],
                        'risk_level' => $properties['risk_level'],
                        'risk_score' => $properties['risk_score']
                    ]
                ];
            }
        }

        return view('maps', [
            'initialMarkers' => $markers,
            'filters' => [
                'city' => $city,
                'month' => $month,
                'year' => $year
            ]
        ]);
    }
}