<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
Illuminate\Contracts\Config\Repository;
use App\Models\AnalyticsConfig;
class AnalyticsProvider implements Repository
{
 
    protected $configValues;

    public function __construct()
    {
        // Load the configuration values from the database or any other source
        $this->configValues = [
            'credentials_json' => storage_path('app/analytics/service-account-credentials.json'),
            // Add other configuration values as needed
        ];
    }

    public function has($key)
    {
        return isset($this->configValues[$key]);
    }

    public function get($key, $default = null)
    {
        return $this->configValues[$key] ?? $default;
    }

    // Implement other methods of the Repository interface as needed
}