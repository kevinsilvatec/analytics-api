# Analytics API
API for get data from Google Analytics Reporting

# Endpoints
The application has two accessible routes: _/analytics_

## /analytics
- Method: POST;
- Function: Get reporting;
- Body Request: 

        {
            "idView": "199497942",
            "startDate": "1daysAgo",
            "endDate": "1daysAgo",
            "metrics": [
                "ga:sessions"
            ],
            "dimensions": [
                "ga:campaign"
            ]
        }

# Observations
The application was made in PHP. For run this application, PHP 7.4+ and composer are required. After of the PHP and composer installed and configurated, runs the _composer install_ command on the root directory of this project to install all dependencies. Next, runs the _php -S localhost:8000 -t public_ command to start the webserver listener.