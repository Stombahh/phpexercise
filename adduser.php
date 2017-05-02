<?php
require_once "user.php";
session_start ();

// Tests have you clicked submit button
if (isset ( $_POST ["submit"] )) {
  	$user = new User ( $_POST ["name"], $_POST ["birthyear"], $_POST ["email"], $_POST ["desc"] );

    $_SESSION ["user"] = $user;
    session_write_close ();
  	// Check fields
  	$nameError = $user->checkName ();
  	$birthyearError = $user->checkBirthyear ();
  	$emailError = $user->checkEmail ();
  	$descError = $user->checkDesc ( false ); // Desc is not required so it is false

    if ($nameError == 0 && $birthyearError == 0 && $emailError == 0 && descError == 0) {
   	  header("location: showUsers.php");
   	  exit;
    }
}
// Tests have you clicked cancel button and closes session if you have clicked

elseif (isset ( $_POST ["cancel"] )) {
    unset($_SESSION ["user"]);
  	header ( "location: index.php" );
  	exit ();
} else {
  if (isset ($_SESSION ["user"])) {
    $user = $_SESSION ["user"];
    $nameError = $user->checkName ();
  	$birthyearError = $user->checkBirthyear ();
  	$emailError = $user->checkEmail ();
  	$descError = $user->checkDesc ( false );
  } else {
  	// Creates empty user object for the first time comers
  	$user = new User ();
  	$nameError = 0;
  	$birthyearError = 0;
  	$emailError = 0;
  	$descError = 0;
  }
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
          <a class="navbar-brand">Welcome to the user list!</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">WELCOME</a></li>
            <li><a href="addUser.php">ADD A NEW USER</a></li>
            <li><a href="showUsers.php">SHOW USERS</a></li>
            <li><a href="settings.php">SETTINGS</a></li>
          </ul>
        </div>
    </div> <!-- Ends container -->
</nav>

      <!-- Begin page content -->
      <div class="container">
        <div class="mt-3">
            <form action="addUser.php" method="post">
              <fieldset>
                <legend>
                  Add a new user:
                </legend>
              <p>
                <label>Name:</label>
                <input type="text" name="name" size="40" value="
                <?php print (htmlentities($user->getName(), ENT_QUOTES, "UTF-8"));?>">
                <?php print ("<span class='pun'>" . $user->getError ( $nameError ) . "</span>") ; ?>
              </p>
              <p>
                <label>Birth year:</label>
                <input type="text" name="birthyear" size="4" maxlength="4" value="
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
            </fieldset>
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
