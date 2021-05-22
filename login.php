<?php
  session_start();
  include("connect.php");
  $loginFailed = "";
  $usersRead = "SELECT * FROM ET_users";
  $usersResult = $conn->query($usersRead);

  if (!$usersRead) {
      echo $conn->error;
  }

  if (isset($_POST['login'])) {
      $username = $conn->real_escape_string(trim($_POST['username']));
      $password = $conn->real_escape_string(trim($_POST['password']));
      $usernameRead = "SELECT * FROM ET_users WHERE username='$username' AND password='$password'";
      $usernameResult = $conn->query($usernameRead);
      $usernameFound = $usernameResult->num_rows;


      if ($usernameFound > 0) {
          while ($row = $usernameResult->fetch_assoc()) {
              $_SESSION['username'] = $row['username'];
              $_SESSION['usernameid'] = $row['userid'];
              $_SESSION['usertype'] = 0;
              $_SESSION['userkey'] = strval(rand(1000, 100000));
              $roleRead = "SELECT * FROM ET_users_role WHERE userid=".$_SESSION['usernameid'];
              $roleResult = $conn->query($roleRead);

              while ($roleCheck = $roleResult->fetch_assoc()) {
                  //usertype = 1 = buyer
                  //usertype = 2 = seller
                  //usertype = 3 = dual
                  $_SESSION['usertype'] += $roleCheck['roleid'];
              }
          }
          header("Location: index.php");
      } else {
          $loginFailed = "<div class='ui negative message'>Wrong username or password</div>";
      }
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

    <script>
    $(document).ready(function () {

      $('.ui.form').form({
        fields: {
          username: {
            identifier: 'username',
            rules: [
              {
                type: 'empty',
                prompt: 'Please enter your username'
              }
            ]
          },
          password: {
            identifier: 'password',
            rules: [
              {
                type: 'empty',
                prompt: 'Please enter your password'
              }
            ]
          }
        }
      });

    });
    </script>
  </head>
  <body>
    <?php
      include("topmenu.php");
     ?>

    <div class="pusher">
      <div class="ui fluid container">
        <div class="ui grid">
          <div class="row">
            <div class="ui two wide column"></div>
            <div class="ui twelve wide column">
                <h2>Login</h2>
            </div>
            <div class="ui two wide column"></div>


          </div>
          <div class="row">
            <div class="ui two wide column"></div>
            <div class="ui twelve wide column">
              <form method="POST" class="ui form" id="loginform">

                <div class="field">
                  <div class="two fields">
                    <div class="field">
                      <label for="">Username</label>

                      <input type="text" name="username" placeholder="username">
                    </div>

                    <div class="field">
                      <label for="">Password</label>

                      <input type="password" name="password" placeholder="password">
                    </div>
                  </div>
                </div>

                <?php echo $loginFailed ?>
                <div class="ui error message"></div>
                <button class="ui right floated button submit" type="submit" name="login">Login</button>
              </form>
            </div>

            <div class="ui two wide column"></div>
          </div>


          </div>

          </div>

      <?php
      include("bottomnav.php");
    ?>

    </div>

    <script type="text/javascript" src="scripts.js"></script>
  </body>
  </html>
