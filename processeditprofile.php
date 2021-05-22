<?php
session_start();
include("connect.php");
$userid = $_GET['userid'];

$userid = openssl_decrypt($userid, "AES-128-ECB", $_SESSION['userkey']);


$updatePassword = $conn->real_escape_string(trim($_POST['password']));
$updateFirstName = $conn->real_escape_string(trim($_POST['firstname']));
$updateLastName = $conn->real_escape_string(trim($_POST['lastname']));
$updateEmail = $conn->real_escape_string(trim($_POST['email']));
$updatePhoneNumber = $conn->real_escape_string(trim($_POST['phonenumber']));
$updateInstitute = $conn->real_escape_string(trim($_POST['institute']));
$updateSeller = $_POST['seller'];
$updateBuyer = $_POST['buyer'];
$updatePic = $_FILES['editProfileImg']['name'];
$updatePicTemp = $_FILES['editProfileImg']['tmp_name'];



$updateProfile =  "UPDATE ET_users SET
                                      password = '$updatePassword',
                                      forename = '$updateFirstName',
                                      surname = '$updateLastName',
                                      email = '$updateEmail',
                                      phonenumber = '$updatePhoneNumber',
                                      institute = '$updateInstitute'
                                      WHERE userid = '$userid'";

  if (!empty($updatePic)) {
      $updatePic = rand(1000, 100000).$updatePic;
      $updateImg = "UPDATE ET_users SET profileimg = '$updatePic' WHERE userid='$userid'";

      $move = move_uploaded_file($updatePicTemp, "profileimgs/$updatePic");
      $updateImgQuery = $conn->query($updateImg);
      if ($updateImgQuery && $move) {
      } else {
          $editFeedback = $conn->error." Not uploaded because of error ".$_FILES['editProfileImg']['error'];
      }
  }

  $updateProfile = $conn->query($updateProfile);

  if ($updateProfile) {
      $editFeedback = "Profile updated";
  } else {
      $editFeedback = "Update failed ".$conn->error;
  }
  ?>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
      <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>

      <link rel="stylesheet" href="style.css">
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
                <?php echo "<h3>$editFeedback</h3>" ?>
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
