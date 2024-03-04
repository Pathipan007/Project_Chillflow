  <?php 
  include('server.php');

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: index.php');
    exit();
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <!-- head -->

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-------- Name ------->
    <title>Mobile App</title>
    <link rel="stylesheet" href="stylelogin.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossoigin />
    <link
      href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>

  <body>
    <header>
      <h2 class="logo"><img src="images/icon.png" width="70%" height="50%"></h2>
      <nav class="navigation">
        <a href="index.php?logout='1'">LOGOUT</a>
      </nav>
    </header>

    <div class="login_success">
        <?php if (isset($_SESSION['success'])):?>
          <div class="success">
            <h3 class="text-regsuccess">
            “<?php echo $_SESSION['success']; unset($_SESSION['success']);?>”
            </h3>
            <h3 class="usersuccess">
                <?php echo $_SESSION['username'];?>
            </h3>
            <button id="back-to-login" class="btn-backtologin">Done</button>
          </div>
        <?php endif ?>
    </div>
    
    <div id="overlay">
      <div class="music">
        <iframe style="border-radius:12px" 
          src="https://open.spotify.com/embed/playlist/37i9dQZF1DX8Uebhn9wzrS?utm_source=generator&theme=0" 
          width="100%" 
          height="352" 
          frameBorder="0" 
          allowfullscreen="" 
          allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
          loading="lazy"></iframe>
      </div>
      <div class="clock">
        <div class="time">
          <span class="hour">00</span>
          <span class="colon">:</span>
          <span class="minute">00</span>
          <span class="colon">:</span>
          <span class="second">00</span>
          <span class="colon ms-colon">:</span>
          <span class="millisecond">00</span>
        </div>
        <div class="buttons">
        <button class="start" onclick="start()" id="startBtn">Start</button>
        <button class="stop" onclick="stop()" id="stopBtn" disabled>Stop</button>
        <button class="reset" onclick="reset()" id="resetBtn" disabled>Reset</button>
        </div>
      </div>
      <div class="background">
       <span class = "bg1"><img src="images/bg.gif" width="150px" height="150px" style="border: 3px solid #eeeeee;   "></span>
       <span class = "bg2"><img src="images/bg1.gif" width="150px" height="150px" style="border: 3px solid #eeeeee;   "></span>
      </div>
    </div>
    <bottom>
        <div class="toolbars">
            <ul>
              <!------Home------>
              <li class="list">
                <div class="icon-home">
                <a href="#">
                  <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                </a>
                </div>
              </li>
              <!------music------>
              <li class="list">
                <a href="#">
                  <span class="icon"><div class="icon-music"><ion-icon name="musical-notes-outline"></div></ion-icon></ion-icon></span>
                </a>
              </li>
              <!------Theme------>
              <li class="list">
                <div class="iconbg">
                <a href="#">
                  <span class="icon"><ion-icon name="image-outline"></ion-icon></span>
                </a>
              </div>
              </li>
              <!------Doc------>
              <li class="list">
                <a href="https://drive.google.com/drive/folders/1StERvGDDDlFuLyFN8hoW4R12kfvngyPp?usp=sharing">
                  <span class="icon"><ion-icon name="document-text-outline"></ion-icon></span>
                </a>
              </li>
              <!------time------>
              <li class="list">
                <div class="icon-time">
                <a href="#">
                  <span class="icon"><ion-icon name="time-outline"></ion-icon></span>
                </a>
                </div>
              </li>
               <!------stat------>
               <li class="list">
                <div class="icon-stat">
                <a href="show_time.php">
                  <span class="icon"><ion-icon name="stats-chart-outline"></ion-icon></ion-icon></span>
                </a>
                 </div>
              </li>
        
            </ul>
          </div>
    </bottom>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="functionlogout.js"></script>
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