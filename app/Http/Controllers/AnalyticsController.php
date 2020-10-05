<?php

namespace App\Http\Controllers;
use App\Helpers\AuthHelper;
use App\Helpers\AnalyticsHelper;
use Illuminate\Http\Request;


class AnalyticsController extends Controller
{
    public function analytics(Request $request){
        $analytics = new AuthHelper();
        $analytics = $analytics->initializeAnalytics();
        
        $idView = $request->idView;        
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $arrMetrics = $request->metrics;
        $arrDimensions = $request->dimensions;
        
        if($request->nextPageToken){
            $nextPageToken = $request->nextPageToken;
        }else{
            $nextPageToken = null;
        }
        
        $response = new AnalyticsHelper();
        $response = $response->getReport($analytics, $idView, $startDate, $endDate, $arrMetrics, $arrDimensions, $nextPageToken);
        
        return response()->json($response['data'], $response['statusCode']);
        
    }


}
