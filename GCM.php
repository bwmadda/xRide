<?php

define("GOOGLE_API_KEY", "AIzaSyD6qsfAWQozGxmgjLMr7SelI8IDUb2t38E"); // Place your Google API Key

class GCM {

    //put your code here
    // constructor
    function __construct() {
        
    }

    /**
     * Sending Push Notification
     */
    public function send_notification($registatoin_ids, $message, $title) {
        // include config
        // include_once './config.php';
        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';

        $data = array('message' => $message, 'title' => $title);

        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $data,
            'notification' => $data,
            "priority" => "high",
        );

        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            //  die('Curl failed: ' . curl_error($ch));
            //  echo $result;
        }

        // Close connection
        curl_close($ch);

        //echo $result;
    }

    public function send_notification_ios($registatoin_ids, $message, $title, $body, $type) {
        // include config
        // include_once './config.php';
        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';

        $data = array('body' => $body, 'title' => 'صوّت', 'type' => $type);

        $fields = array(
            'registration_ids' => $registatoin_ids,
            'notification' => $data,
            "priority" => "high",
            "content_available" => true,
            "sound" => "default",
            "badge" => "2",
            "body" => $body,
        );


        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            //  die('Curl failed: ' . curl_error($ch));
            //  echo $result;
        }

        // Close connection
        curl_close($ch);

//echo json_encode($fields); die;
        // echo $result;die;
    }

}

?>
