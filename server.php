<?php
    session_start();

    // initializing variables
    $username = "";
    $email    = "";
    $errors = array(); 

    // connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'chillflow_time');


// REGISTER USER
    // ตรวจสอบค่าที่มาจากฟอร์ม โดยมีชื่อฟอร์มเป็น reg_user
    if (isset($_POST['reg_user'])) {
        // escape ค่าเพื่อป้องกันการ SQL injection
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

        if(empty($username)) {
            array_push($errors, "Username is required");
        }
        if(empty($email)) {
            array_push($errors, "Email is required");
        }
        if(empty($password_1)) {
            array_push($errors, "Password is required");
        }
        if ($password_1 != $password_2) {
            array_push($errors, "The two passwords do not match");
        }
        // ตรวจสอบว่ามี username และ email ซ้ำในฐานข้อมูลไหม
        $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email' ";
        $query = mysqli_query($db, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if($result) {
            if ($result['username'] == $username){
                array_push($errors, "Username already exists");
            }
            if ($result['email'] == $email){
                array_push($errors, "Email already exists");
            }
        }
        // ไม่มี error
        if (count($errors) == 0) {
            // เพิ่มข้อมูลผู้ใช้ใหม่ลงในฐานข้อมูล
            $password = password_hash($password_1, PASSWORD_DEFAULT); 
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')";
            mysqli_query($db, $sql);

            $_SESSION['username'] = $username;
            $_SESSION['regsuccess'] = "Register Successfully";
            header("location: index.php");
            
        } else {
            $_SESSION['error'] = implode(", ", $errors);
            header("location: index.php");
        }
    }


// LOGIN USER 
    // ตรวจสอบค่าที่มาจากฟอร์ม โดยมีชื่อฟอร์มเป็น login_user
    if (isset($_POST['login_user'])) {
        // escape ค่าเพื่อป้องกันการ SQL injection
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
    
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
        // ไม่มี error
        if (count($errors) == 0) {
            // ตรวจสอบหาชื่อผู้ใช้ในฐานข้อมูล หากไม่มีให้ขึ้น error
            $query = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($db, $query);
            // ตรวจสอบว่ามีข้อมูลผู้ใช้ที่ค้นพบในฐานข้อมูลหรือไม่
            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                // ทำการตรวจสอบรหัสผ่านว่าตรงกับที่ผู้ใช้ป้อนหรือไม่ 
                if (password_verify($password, $user['password'])) {
                    // เก็บค่า id ของผู้ใช้และชื่อผู้ใช้
                    $_SESSION['timedata_user_id'] = $user['id'];
                    $_SESSION['totaltime_user_id'] = $user['id'];
                    $_SESSION['timedata_user_name'] = $user['username'];
                    $_SESSION['totaltime_user_name'] = $user['username'];

                    $timedata_user_id = $_SESSION['timedata_user_id'];
                    $timedata_user_name = $_SESSION['timedata_user_name'];
                    $totaltime_user_id = $_SESSION['totaltime_user_id']; 
                    $totaltime_user_name = $_SESSION['totaltime_user_name'];

                    // ค้นหาข้อมูลในตาราง totaltime_data สำหรับผู้ใช้ที่ login เข้ามา
                    $check_query = "SELECT * FROM totaltime_data WHERE totaltime_user_id = '$totaltime_user_id'";
                    $check_result = mysqli_query($db, $check_query);
                    // หากยังไม่มีข้อมูลในตาราง ให้ทำการเพิ่มข้อมูลลงไป
                    if (mysqli_num_rows($check_result) == 0) {
                        $sql_totaltime = "INSERT INTO totaltime_data (totaltime_user_id,totaltime_user_name) VALUES ('$totaltime_user_id','$totaltime_user_name')";
                        if ($db->query($sql_totaltime) === TRUE) {
                            echo "Totaltime Data created successfully";
                        } else {
                            echo "Error: " . $sql_totaltime . "<br>" . $db->error;
                        }
                    }  
                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = "Welcome to ChillFlow";
                    header("location: welcome.php");
                } else {               
                    array_push($errors, "Wrong password");
                    $_SESSION['error'] = "Wrong password";
                    header("location: index.php");
                }
            } else {      
                array_push($errors, "Username not found");
                $_SESSION['error'] = "Username not found";
                header("location: index.php");
            }
        }
    }
?>