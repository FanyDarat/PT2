<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FloodPredictionController extends Controller
{
    // URL API eksternal
    private const API_URL = 'http://floonder-api.kakashispiritnews.my.id/api/public/gis/flood-point';

    public function index()
    {
        return view('flood-prediction.index');
    }

    public function getPredictionData(Request $request)
    {
        try {
            // Build query parameters from request
            $queryParams = [
                'kota' => $request->input('city'),
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'limit' => $request->input('limit', 10000) // Default limit
            ];

            // Remove null parameters
            $queryParams = array_filter($queryParams);

            // Make API request
            $response = Http::timeout(30)->get(self::API_URL, $queryParams);

            // Check for successful response
            if (!$response->successful()) {
                throw new \Exception("API request failed with status: " . $response->status());
            }

            // Get JSON response
            $data = $response->json();

            // Validate response structure
            if (!isset($data['results']['features'])) {
                throw new \Exception("Invalid API response structure");
            }

            // Transform data to match frontend expectations
            $transformedData = [
                'type' => 'FeatureCollection',
                'features' => array_map(function ($feature) {
                    return [
                        'type' => 'Feature',
                        'geometry' => $feature['geometry'] ?? null,
                        'properties' => array_merge(
                            $feature['properties'] ?? [],
                            [
                                'risk_level' => $this->mapRiskLevel($feature['properties']['risk_level'] ?? null),
                                'risk_score' => $this->calculateRiskScore($feature['properties'] ?? [])
                            ]
                        )
                    ];
                }, $data['results']['features'])
            ];

            return response()->json($transformedData);

        } catch (\Exception $e) {
            Log::error('Flood prediction API error: ' . $e->getMessage());
            
            // Return fallback data if API fails
            return response()->json([
                'type' => 'FeatureCollection',
                'features' => [
                    [
                        'type' => 'Feature',
                        'geometry' => [
                            'type' => 'Point',
                            'coordinates' => [107.61, -6.91]
                        ],
                        'properties' => [
                            'risk_level' => 'Error',
                            'risk_score' => 0,
                            'message' => 'Failed to load data: ' . $e->getMessage()
                        ]
                    ]
                ]
            ], 500);
        }
    }

    /**
     * Map API risk levels to standardized values
     */
    private function mapRiskLevel($apiRiskLevel)
    {
        $mapping = [
            'low' => 'Rendah',
            'medium' => 'Sedang',
            'high' => 'Tinggi',
            'very_high' => 'Sangat Tinggi'
        ];

        return $mapping[strtolower($apiRiskLevel)] ?? $apiRiskLevel ?? 'Tidak Diketahui';
    }

    /**
     * Calculate risk score based on API properties
     */
    private function calculateRiskScore($properties)
    {
        // Simple scoring algorithm - adjust as needed based on API data
        $score = 0;
        
        if (isset($properties['flood_probability'])) {
            $score += $properties['flood_probability'] * 100;
        }
        
        if (isset($properties['historical_events'])) {
            $score += count($properties['historical_events']) * 5;
        }
        
        return min(100, max(0, $score)); // Ensure score is between 0-100
    }

    /**
     * Get available filter options from API
     */
    public function getFilterOptions()
    {
        try {
            $response = Http::get(self::API_URL . '/meta');
            
            if ($response->successful()) {
                return response()->json($response->json());
            }
            
            return response()->json([
                'cities' => [],
                'years' => range(date('Y') - 5, date('Y')),
                'months' => array_map(function ($m) {
                    return [
                        'value' => $m,
                        'name' => date('F', mktime(0, 0, 0, $m, 1))
                    ];
                }, range(1, 12))
            ]);
            
        } catch (\Exception $e) {
            Log::error('Failed to get filter options: ' . $e->getMessage());
            return response()->json([], 500);
        }
    }
}