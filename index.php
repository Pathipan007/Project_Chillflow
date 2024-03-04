<?php include('server.php'); ?> 
<!DOCTYPE html>
<html lang="en">
  <!-- head -->

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-------- Name ------->
    <title>Mobile App</title>
    <link rel="stylesheet" href="style.css" />
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
      <h2 class="logo"><img src="images/icon.png" width="100%" height="150"></h2>
      <nav class="navigation">

        <button class="btnLogin-popup">Login</button>
      </nav>
    </header>

    <div class="detect_success">
        <?php if (isset($_SESSION['regsuccess'])):?>
          <div class="reg_success">
            <h3 class="text-regsuccess">
            “<?php echo $_SESSION['regsuccess']; unset($_SESSION['regsuccess']);?>”
            </h3>
            <h3 class="usersuccess">
                <?php echo $_SESSION['username'];?>
            </h3>
            <button id="back-to-login" class="btn-regbacktologin">Login</button>
          </div>
        <?php endif ?>
    </div>

    <div class="detect_error">
      <?php if (isset($_SESSION['error'])):?>
        <div class="error">
          <h3 class="text-error">
          “<?php echo $_SESSION['error']; unset($_SESSION['error']);?>”
          </h3>
          <button id="back-to-login" class="btn-backtologin">Done</button>
        </div>
      <?php endif ?>
    </div>

    <div id="overlay">
      <div id="pop-up">
        <div class="wrapper">
          
          <span class="icon-close"
            ><ion-icon name="close-circle"></ion-icon
          ></span>
          <div class="form-box login">
            <h2>Login</h2>
            <form action="server.php" method="post">
            <?php include('errors.php'); ?>
              <div class="input-box">
                <span class="icon"
                  ><ion-icon name="person-circle"></ion-icon
                ></span>
                <input type="text" name="username" required />
                <label>USERNAME</label>
              </div>
              <div class="input-box">
                <span class="icon"
                  ><ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password" name="password" required />
                <label>PASSWORD</label>
              </div>
              <div class="remember-forgot">
                <label><input type="checkbox" />Remember me</label>
                <a href="#">Forgot Password?</a>
              </div>
              <button type="submit" class="btn" name="login_user">Login</button>
              <div class="login-register">
                <p>
                  Don't have an account?
                  <a href="#" class="register-link">Register</a>
                </p>
              </div>
            </form>
          </div>

          <div class="form-box register">
            <h2>Register</h2>
            <form  action="server.php" method="post">
            <?php include('errors.php'); ?>
              <div class="input-box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="email" name="email" value = "<?php echo $email; ?>" required />
                <label>EMAIL</label>
              </div>
              <div class="input-box">
                <span class="icon"
                  ><ion-icon name="person-circle"></ion-icon
                ></span>
                <input type="text" name="username" value="<?php echo $username; ?>" required />
                <label>USERNAME</label>
              </div>
              <div class="input-box">
                <span class="icon"
                  ><ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password" name="password_1" required />
                <label>PASSWORD</label>
              </div>
              <div class="input-box">
                <span class="icon"
                  ><ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type="password" name="password_2" required />
                <label>CONFIRM PASSWORD</label>
              </div>
              <div class="remember-forgot">
                <label
                  ><input type="checkbox" required />I agree to the terms &
                  conditions</label
                >
              </div>
              <button type="submit" class="btn" name="reg_user">Register</button>
              <div class="login-register">
                <p>
                  already have an account?
                  <a href="#" class="login-link">Login</a>
                </p>
              </div>
            </form>
          </div>
        </div>

      </div>
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
                <a href="#">
                  <span class="icon"><ion-icon name="stats-chart-outline"></ion-icon></ion-icon></span>
                </a>
                 </div>
              </li>
        
            </ul>
          </div>
    </bottom>
    <script src="functionlogin.js"></script>
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