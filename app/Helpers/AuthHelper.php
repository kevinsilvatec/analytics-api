<?php

namespace App\Helpers;

use Google_Client;
use Google_Service_AnalyticsReporting;

class AuthHelper{

    public function initializeAnalytics()
    {
      $KEY_FILE_LOCATION = storage_path() . '\app\client_secrets.json';
      $client = new Google_Client();
      $client->setApplicationName("MIS_GoogleAnalytics");
      $client->setAuthConfig($KEY_FILE_LOCATION);
      $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
      $analytics = new Google_Service_AnalyticsReporting($client);
      return $analytics;
    }
}