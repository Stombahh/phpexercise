<!DOCTYPE html>
<html lang="en">
<head>
  <title>User list</title>
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
            <button type="button" class="navbar-toggle" data-toggle="collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Welcome to the user list!</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">WELCOME</a></li>
            <li><a href="addUser.php">ADD A NEW USER</a></li>
            <li><a href="showUsers.php">SHOW USERS</a></li>
            <li><a href="listUsers.php">LIST USERS</a></li>
            <li><a href="settings.php">SETTINGS</a></li>
          </ul>
        </div>
    </div> <!-- Ends container -->
</nav>

      <!-- Begin page content -->
      <div class="container">
        <div class="mt-3">
          <h1>User information saved succesfully!</h1>
          <a href="index.php"><input type="button" value="Back to main page"></a>
        </div>
      </div>

      <footer class="footer">
        <div class="container">
          <span class="text-muted">This is footer</span>
        </div>
      </footer>

</body>
</html>
