<?php

function send_push_torider($type, $riderid, $message, $title) {
    require 'db.php';
    include_once 'GCM.php';
    $result = mysqli_query($conn, "select * from tbl_gcm where user_id ='$riderid'") or die(mysql_error());
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $userid=$row['user_id'];
    $gcmid = $row["gcmid"];
    $devicetype = $row['device_type'];
    if ($gcmid) {
        $regId = $gcmid;
        $gcm = new GCM();
        $registatoin_ids = array($regId);
        if ($devicetype == 'android') {
            $msgary = array(
                'type' => $type,
                'message' => $message
            );
            $res = $gcm->send_notification($registatoin_ids, $msgary, $title);
        } else if ($devicetype == 'ios') {
            $msgary = array(
                'type' => $type,
                'message' => $message,
            );
            $res = $gcm->send_notification_ios($registatoin_ids, $msgary, $title, $message);
        }
        mysqli_query($conn, "insert into push_history (user_id,message) values ($userid,'$message')") or die(mysql_error());
    }
}

?>
