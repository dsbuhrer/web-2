<?php

namespace App\Helpers;

class Logger{

    /**
     * @throws Exception
     */
    public static function log($log_msg)
    {
        $filename = "Storage";
        if (!file_exists($filename)) 
        {
            // create directory/folder uploads.
            mkdir($filename, 0777, true);
        }
        $log_file_data = $filename.'/info'.'.log';
        // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
        file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
    }
}