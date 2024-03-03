<?php
session_start();
include('server.php');
$timezone = $_POST['timezone'];
date_default_timezone_set($timezone);

// รับค่าจาก POST request
$hour = $_POST['hour'];
$minute = $_POST['minute'];
$second = $_POST['second'];
$datetime = date("d/m/y"); //date time
$subtime = date("H:i:s"); //time
$timedata_user_id = $_SESSION['timedata_user_id']; // รับค่า user_id จาก session
$timedata_user_name = $_SESSION['timedata_user_name'];

// เตรียมคำสั่ง SQL สำหรับการบันทึกข้อมูล
$sql = "INSERT INTO time_data (timedata_user_id, timedata_user_name, hour, minute, second, datetime, timedataformat, subtime) 
        VALUES ('$timedata_user_id', '$timedata_user_name', '$hour', '$minute', '$second', '$datetime', 
        CONCAT(LPAD('$hour', 2, '0'), ':', LPAD('$minute', 2, '0'), ':', LPAD('$second', 2, '0')), '$subtime')";

// ทำการบันทึกข้อมูล
if ($db->query($sql) === TRUE) {
    echo "Record saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Update time_data format
$sqlUpdateTimedataformat = "UPDATE time_data SET 
    timedataformat = CONCAT(
        IF(hour < 10, LPAD(hour, 2, '0'), hour),
        ':', 
        LPAD(minute, 2, '0'), 
        ':', 
        LPAD(second, 2, '0')
    ) WHERE timedata_user_id = $timedata_user_id";
$db->query($sqlUpdateTimedataformat);

// Update totaltime_data
$sqlUpdateTotaltimeData = "UPDATE totaltime_data SET
    total_hours = (SELECT FLOOR(SUM(hour * 3600 + minute * 60 + second) / 3600) FROM time_data WHERE time_data.timedata_user_id = $timedata_user_id),
    total_minutes = (SELECT FLOOR(SUM(hour * 60 + minute + second / 60)) FROM time_data WHERE time_data.timedata_user_id = $timedata_user_id),
    total_seconds = (SELECT SUM(hour * 3600 + minute * 60 + second) FROM time_data WHERE time_data.timedata_user_id = $timedata_user_id)
    WHERE totaltime_user_id = $timedata_user_id";
$db->query($sqlUpdateTotaltimeData);

// Update minute_format
$sqlUpdateMinuteFormat = "UPDATE totaltime_data SET 
    minute_format = ABS(FLOOR(total_seconds / 60) - (FLOOR(total_seconds / 3600) * 60)) 
    WHERE totaltime_user_id = $timedata_user_id";
$db->query($sqlUpdateMinuteFormat);

// Update second_format
$sqlUpdateSecondFormat = "UPDATE totaltime_data SET 
    second_format = total_seconds - (FLOOR(total_seconds / 60) * 60) 
    WHERE totaltime_user_id = $timedata_user_id";
$db->query($sqlUpdateSecondFormat);

// Update timeformat
$sqlUpdateTimeformat = "UPDATE totaltime_data SET 
    timeformat = CONCAT(
        IF(total_hours < 10, LPAD(total_hours, 2, '0'), total_hours), 
        ':', 
        LPAD(total_minutes - (total_hours*60), 2, '0'), 
        ':', 
        LPAD(total_seconds - (total_minutes*60), 2, '0')
    ) WHERE totaltime_user_id = $timedata_user_id";
$db->query($sqlUpdateTimeformat);

// Update global_timeformat
$sqlUpdateGlobalTimeformat = "UPDATE totaltime_data SET 
    global_timeformat = (
        SELECT TIME_FORMAT(SEC_TO_TIME(SUM(hour*3600 + minute*60 + second)), '%H:%i:%s') 
        FROM time_data 
        WHERE time_data.timedata_user_id = $timedata_user_id
    ) WHERE totaltime_user_id = $timedata_user_id";
$db->query($sqlUpdateGlobalTimeformat);

// ปิดการเชื่อมต่อกับ MySQL
$db->close();

?>
