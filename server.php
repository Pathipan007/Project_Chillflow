<?php
    session_start();

    // initializing variables
    $username = "";
    $email    = "";
    $errors = array(); 

    // connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'savetime_v12');


    // REGISTER USER
    if (isset($_POST['reg_user'])) {
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
        
        if (count($errors) == 0) {
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
    if (isset($_POST['login_user'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
    
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
    
        if (count($errors) == 0) {
            $query = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                if (password_verify($password, $user['password'])) {
                    $_SESSION['timedata_user_id'] = $user['id'];
                    $_SESSION['totaltime_user_id'] = $user['id'];
                    $_SESSION['timedata_user_name'] = $user['username'];
                    $_SESSION['totaltime_user_name'] = $user['username'];

                    $totaltime_user_id = $_SESSION['totaltime_user_id'];
                    $totaltime_user_name = $_SESSION['totaltime_user_name'];
                    $check_query = "SELECT * FROM totaltime_data WHERE totaltime_user_id = '$totaltime_user_id'";
                    $check_result = mysqli_query($db, $check_query);
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