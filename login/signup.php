<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>My login example</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style2.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
</head>
<body>
  <div class="cont">
    <div class="form sign-in">
      <h2>Sign In</h2>
        <?php
            if(isset($_SESSION['u_id'])) {
                echo '<form action="includes/logout.inc.php" method="post"><p>Ačiū kad prisijungėte</p><button type="submit" name="submit" class="submit">Logout</button></form>';
                } else {
                    echo '<form action="includes/login.inc.php" method="post"><label><span>Username</span>        <input type="text" name="uid"></label><label>        <span>Password</span><input type="password" name="pwd"></label><button type="submit" name="submit" class="submit">Sign In</button></form>';
                 }
        ?>    
        
      <div class="social-media">
        <ul>
          <li><img src="images/facebook.png"></li>
          <li><img src="images/twitter.png"></li>
          <li><img src="images/linkedin.png"></li>
          <li><img src="images/instagram.png"></li>
        </ul>
      </div>
    </div>

    <div class="sub-cont">
      <div class="img">
        <div class="img-text m-up">
          <h2>New here?</h2>
          <p>Sign up!</p>
        </div>
        <div class="img-text m-in">
          <h2>If you already has an account, just sign in.</h2>
        </div>
        <div class="img-btn">
          <span class="m-up">Sign Up</span>
          <span class="m-in">Sign In</span>
        </div>
      </div>
      <div class="form sign-up" id="signup">
        <h2>Sign Up</h2>
          
          
        <form class="signup-form" action="includes/signup.inc.php" method="post">
            <label>
              <span>Name</span>
              <input type="text" name="first">
            </label>
            <label>
              <span>Second Name</span>
              <input type="text" name="last">
            </label>
            <label>
              <span>Email</span>
              <input type="text" name="email">
            </label>
            <label>
              <span>Username</span> 
              <input type="text" name="uid">
            </label>
            <label>
              <span>Password</span>
              <input type="password" name="pwd">
            </label>
            <label>
              <button type="submit" name="submit" class="submit">Sign Up Now</button>
            </label>
</form>
      </div>
    </div>
  </div>
<script type="text/javascript" src="script.js"></script>
</body>
</html>