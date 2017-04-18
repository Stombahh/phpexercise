<?php
require_once "user.php";

// Tests have you clicked submit button
if (isset ( $_POST ["submit"] )) {
  	$user = new User ( $_POST ["name"], $_POST ["birthyear"], $_POST ["email"], $_POST ["desc"] );

  	// Check fields
  	$nameError = $user->checkName ();
  	$birthyearError = $user->checkBirthyear ();
  	$emailError = $user->checkEmail ();
  	// Desc is not required so it is false
  	$descError = $user->checkDesc ( false );
}
// Tests have you clicked cancel button
elseif (isset ( $_POST ["cancel"] )) {
  	header ( "location: index.php" );
  	exit ();
} else {
  	// Creates user without parameters
  	$user = new User ();

  	// Initialize error variables
  	$nameError = 0;
  	$birthyearError = 0;
  	$emailError = 0;
  	$descError = 0;
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Add user</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

  <nav class="navbar navbar-inverse"  data-offset-top="650" style="border-radius:0">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Welcome to the user list!</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">USERS</a></li>
            <li><a href="adduser.php">ADD A NEW USER</a></li>
          </ul>
        </div>
    </div> <!-- Ends container -->
</nav>

      <!-- Begin page content -->
      <div class="container">
        <div class="mt-3">
          <h2>Add a new user:</h1>
            <form action="adduser.php" method="post">
              <p>
                <label>Name:</label>
                <input type="text" name="name" size="40" value="
                <?php print (htmlentities($user->getName(), ENT_QUOTES, "UTF-8"));?>">
                <?php print ("<span class='pun'>" . $user->getError ( $nameError ) . "</span>") ; ?>
              </p>
              <p>
                <label>Birth year:</label>
                <input type="number" name="birthyear" size="4" maxlength="4" value="
                <?php print (htmlentities($user->getBirthyear(), ENT_QUOTES, "UTF-8"));?>">
                <?php print ("<span class='pun'>" . $user->getError ( $birthyearError ) . "</span>") ;?>
              </p>
              <p>
                <label>E-mail:</label>
                <input type="text" name="email" size="40" value="
                  <?php print (htmlentities($user->getEmail(), ENT_QUOTES, "UTF-8"));?>">
                  <?php print ("<span class='pun'>" . $user->getError ( $emailError ) . "</span>") ;?>
              </p>
              <p>
                <label>Description:</label>
                <textarea rows="4" cols="40" name="desc">
                <?php print (htmlentities($user->getDesc(), ENT_QUOTES, "UTF-8"));?>
                </textarea>
                <?php print ("<span class='pun' style='vertical-align:top'>" . $user->getError ( $descError ) . "</span>") ;?>
              </p>
              <p>
        				<label>&nbsp;</label>
                <input type="submit" name="submit" value="Submit">
                <input type="submit" name="cancel" value="Cancel">
        			</p>
            </form>
        </div>
      </div>

      <footer class="footer">
        <div class="container">
          <span class="text-muted">This is footer</span>
        </div>
      </footer>

</body>
</html>
