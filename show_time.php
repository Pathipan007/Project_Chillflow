<?php
session_start();
include('session.php');
$timedata_user_id = $_SESSION['timedata_user_id'];
$timedata_user_name = $_SESSION['timedata_user_name'];
$totaltime_user_id = $_SESSION['totaltime_user_id']; 
$totaltime_user_name = $_SESSION['totaltime_user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show time</title>
    <link rel="stylesheet" href="showtime.css">
</head>
<body>
    <header>
      <nav class="navigation">
        <a href="welcome.php"><span class=""
            ><ion-icon name="arrow-undo-circle"></ion-icon></span></a>
        </nav>
        <h2 class="logo"><img src="images/icon.png" width="100%" height="150px"></h2>
    </header>
    <img class="imagetrophy" src="images/trophyv1.png">
    <img class="imagebackgruondtrophy1" src="images/backgroundtrophy1.jpg">

 <?php 
        $sql_totaltime_data = "SELECT totaltime_user_name, timeformat FROM totaltime_data WHERE totaltime_user_id='$totaltime_user_id'";
        $result_totaltime_data = $conn->query($sql_totaltime_data);
        
        if ($result_totaltime_data->num_rows > 0) {
            while ($row_totaltime_data = $result_totaltime_data->fetch_assoc()) {
                $totaltime_user_name_result = $row_totaltime_data["totaltime_user_name"];
                $timeformat_result = $row_totaltime_data["timeformat"];
            }
        } else {
            echo "No user data found";
        }
    ?>
    <div class='totaltime'>
        <h3><?php echo $timeformat_result; ?></h3>
        <p>hr/min/sec</p>   
    </div>

    <div class='show-username'>
        <img class="imagelogosword" src="images/logoswordv1.png">
        <p>Username : <?php echo $totaltime_user_name_result; ?></p>
    </div>

    <div class='time-list'>
        <?php
            $sql_timedata = "SELECT subtime,datetime,timedataformat FROM time_data WHERE timedata_user_id='$timedata_user_id' ORDER BY id DESC LIMIT 20";
            $result_timedata = $conn->query($sql_timedata);

            if ($result_timedata->num_rows > 0) {
                while ($row_timedata = $result_timedata->fetch_assoc()) {
                    $subtime = $row_timedata["subtime"];
                    $datetime = $row_timedata["datetime"];
                    $timedataformat = $row_timedata["timedataformat"];

                    echo "<div class='time-item'>

                            <div class='date-time'>
                                <div class='text-datetime'>
                                    <p class='edit-textdate'>Date:⠀</p>
                                    <p class='edit-texttime'> $datetime</p>
                                </div>
                                <div class='text-subtime'>
                                    <p>Submit⠀at:⠀</p>
                                    <p>$subtime</p>
                                </div>
                            </div>

                            <div class='border-timedata'>
                                <h3 class='historytime'> $timedataformat </h3>
                                <p class='historytimeformat'> Hour/Minute/Second </p>
                            </div>

                        </div>";
                }
            } else {
                echo "<p class='no-timedata'>You don't have time history.</p>";
            }
            $conn->close();
        ?>
    </div>
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
</body>
</html>