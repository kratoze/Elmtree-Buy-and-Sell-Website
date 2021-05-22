<?php
  session_start();

  if (!isset($_SESSION['username'])) {
      $_SESSION['userkey'] = strval(rand(1000, 100000));
  }

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>

    <link rel="stylesheet" href="style.css">


    <title>My Shop Project</title>
  </head>
  <body>
    <?php
      include("topmenu.php");
     ?>

    <!-- ************************ PAGE CONTENT ************************ -->
    <div class="pusher">
      <div class="ui fluid container">

      <div class="ui grid">

        <?php
          include("displayproducts.php");
        ?>
      </div>

    </div>

      <div>
      <?php
        include("bottomnav.php");
       ?>
     </div>

    </div>

    <script type="text/javascript" src="scripts.js"></script>
</body>
</html>
