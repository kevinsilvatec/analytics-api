<?php

namespace App\Helpers;

use Google_Service_AnalyticsReporting_DateRange;
use Google_Service_AnalyticsReporting_Metric;
use Google_Service_AnalyticsReporting_Dimension;
use Google_Service_AnalyticsReporting_ReportRequest;
use Google_Service_AnalyticsReporting_GetReportsRequest;

class AnalyticsHelper{
  
  public function getReport($analytics, $idView, $startDate, $endDate, $arrMetrics, $arrDimensions, $pageToken) {  
    try {
      $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        
      $dateRange->setStartDate($startDate);
      $dateRange->setEndDate($endDate);

      $newArrMetrics = [];

      for ($i=0; $i < sizeof($arrMetrics); $i++) { 
        $metric = new Google_Service_AnalyticsReporting_Metric();
        $metric->setExpression($arrMetrics[$i]);
        array_push($newArrMetrics, $metric);
      }
    
      $newArrDimensions = [];
      for ($j=0; $j < sizeof($arrDimensions) ; $j++) {
        $dimension = new Google_Service_AnalyticsReporting_Dimension();
        $dimension->setName($arrDimensions[$j]);
        array_push($newArrDimensions, $dimension);
      }
    
      $request = new Google_Service_AnalyticsReporting_ReportRequest();
      $request->setViewId($idView);
      $request->setDateRanges($dateRange);
      $request->setDimensions($newArrDimensions);
      $request->setMetrics($newArrMetrics);

      if(!is_null($pageToken)){
        $request->setPageToken($pageToken);
      }
      
      $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
      $body->setReportRequests(array($request));

      $result = $analytics->reports->batchGet($body);
      if($result){
        $data = [
          'data' => $result,
          'statusCode'=> 200
        ];
        return $data;
      }else{
        $data = [
          'data' => 'Error during try get reports | ' .$e->getMessage(). '. Line: ' . $e->getLine(),
          'statusCode'=> 500
        ];
        return $data;
      }

    } catch (\Exception $e) {
      $data = [
        'data' => 'Error during the proccess | ' .$e->getMessage(). '. Line: ' . $e->getLine(),
        'statusCode'=> 500
      ];
      return $data;
    }
  }
}