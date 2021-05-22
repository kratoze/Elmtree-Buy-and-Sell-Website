<?php
  session_start();
  include("connect.php");

  if (!isset($_SESSION['username'])) {
      header("Location: index.php");
  }

  $readInstitute = "SELECT * FROM ET_institutes";
  $readTotalInstitutes = "SELECT COUNT(*) AS total FROM ET_institutes";
  $resultInstitute = $conn->query($readInstitute);
  $resultTotalInstitutes = $conn->query($readTotalInstitutes);
  $totalInstitutes = $resultTotalInstitutes->fetch_assoc();
  $userid = $_SESSION['usernameid'];

  $readUser = "SELECT * FROM ET_users WHERE userid = '$userid'";
  $resultUser = $conn->query($readUser);
  $user = $resultUser->fetch_assoc();
  $userid = $user['userid'];
  $username = $user['username'];
  $userFirstName = $user['forename'];
  $userLastName = $user['surname'];
  $userEmail = $user['email'];
  $userPhone = $user['phonenumber'];
  $userProfileImg = $user['profileimg'];
  $userInstitute = $user['institute'];

  $sellerChecked = "";
  $buyerChecked = "";
  $userType = "SELECT * FROM ET_users_role WHERE userid ='$userid'";
  $resultUserType = $conn->query($userType);
  while ($types = $resultUserType->fetch_assoc()) {
      if ($types['roleid'] == 1) {
          $buyerChecked = "checked";
      }

      if ($types['roleid'] == 2) {
          $sellerChecked = "checked";
      }
  }

  $userid = openssl_encrypt($userid, "AES-128-ECB", $_SESSION['userkey']);

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

        $.fn.form.settings.rules.isAccountType = function (value, param) {
          if ($('#buyerSelectioneditProfile').is(':checked') || $('#sellerSelectioneditProfile').is(':checked')) {
            return true;
          } else {
            return false;

          }

        }

        $(function () {
          $('.ui.form').form({
            inline: true,
            fields: {
              firstName: {
                identifier: 'firstname',
                rules: [
                  {
                    type: 'empty',
                    prompt: 'Please enter your first name'
                  }, {
                    type: 'maxLength[50]',
                    prompt: 'First name must be less than 50 characters'
                  }
                ]
              },
              lastName: {
                identifier: 'lastname',
                rules: [
                  {
                    type: 'empty',
                    prompt: 'Please enter your last name'
                  }, {
                    type: 'maxLength[50]',
                    prompt: 'Last name must be less than 50 characters'
                  }
                ]
              },
              username: {
                identifier: 'username',
                rules: [
                  {
                    type: 'empty',
                    prompt: 'Please enter your username'
                  }, {
                    type: 'minLength[3]',
                    prompt: 'Username must be at least 3 characters'
                  }, {
                    type: 'maxLength[50]',
                    prompt: 'Username must be less than 50 characters'
                  }
                ]
              },
              password: {
                identifier: 'password',
                rules: [
                  {
                    type: 'empty',
                    prompt: 'Please enter your password'
                  }, {
                    type: 'minLength[6]',
                    prompt: 'Password must be at least 6 characters'
                  }, {
                    type: 'maxLength[128]',
                    prompt: 'Password must be less than 150 characters'
                  }
                ]
              },
              email: {
                identifier: 'email',
                rules: [
                  {
                    type: 'empty',
                    prompt: 'Please enter your email address'
                  }, {
                    type: 'email',
                    prompt: 'Please enter a valid email address'
                  }, {
                    type: 'maxLength[300]',
                    prompt: 'Your email must be less than 300 characters'
                  }
                ]
              },
              phonenumber: {
                identifier: 'phonenumber',
                rules: [
                  {
                    type: 'empty',
                    prompt: 'Please enter your phone number'
                  }, {
                    type: 'minLength[6]',
                    prompt: 'Your phone number must be longer than 6 digits'
                  }, {
                    type: 'maxLength[20]',
                    prompt: 'Your phone number must be less than 20 digits'
                  }, {
                    type: 'number',
                    prompt: 'Please enter a valid phone number'
                  }
                ]
              },
              institute: {
                identifier: 'institute',
                rules: [
                  {
                    type: 'empty',
                    prompt: 'Please choose an institute'
                  }, {
                    type: 'integer[1, <?php echo $totalInstitutes['total'] ?>]',
                    prompt: "Please choose a valid institute"
                  }
                ]
              },
              accounttype: {
                identifier: 'seller',
                rules: [
                  {

                    type: 'isAccountType',
                    prompt: 'Please choose an account type'
                  }
                ]
              },
              // checkbox: {   identifier: 'seller',   rules: [     {       type: 'checked',       prompt: 'Please choose an account type'     }   ] },
            }

          })

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
              <h2>Please enter your details to register</h2>
            </div>
            <div class="ui two wide column"></div>

          </div>
          <div class="row">
            <div class="ui two wide column"></div>
            <div class="ui twelve wide column">
              <form method="POST" id="editProfileForm" action=<?php echo "/elmtree/processeditprofile.php?userid=".$userid ?> enctype="multipart/form-data" class="ui form">
                <div class="field">
                  <label for="firstname">Name</label>
                  <div class="two fields">
                    <div class="field">
                      <input type="text" id="firstNameeditProfile" name="firstname" value=<?php echo "$userFirstName" ?>>
                    </div>
                    <div class="field">
                      <input type="text" id="lastNameeditProfile" name="lastname" value=<?php echo "$userLastName" ?>>
                    </div>

                  </div>
                </div>
                <div class="field">
                  <div class="two fields">
                    <div class="field">
                      <label for="username">Username</label>
                      <div class="ui disabled input">
                        <input type="text" id="usernameeditProfile" name="username" value=<?php echo "$username" ?>>
                      </div>
                    </div>

                    <div class="field">
                      <label for="password">Password</label>

                      <input type="password" id="passwordeditProfile" name="password" value="password">
                    </div>
                  </div>
                </div>
                <div class="field">
                  <label for="email">Email</label>

                  <input type="text" id="emaileditProfile" name="email" value=<?php echo "$userEmail" ?>>
                </div>

                <div class="field">
                  <label for="phoneNumber">Phone Number</label>

                  <input type="number" id="phoneNumbereditProfile" name="phonenumber" value=<?php echo "$userPhone" ?>>
                </div>

                <div class="inline fields stackable">

                  <div class="field">

                    <label for="institute">Institute</label>
                    <select name="institute" id="instituteeditProfile" class="fluid dropdown">
                    <?php


                        if (!$resultInstitute) {
                            echo $conn->error;
                        } else {
                            while ($row = $resultInstitute->fetch_assoc()) {
                                $instituteID = $row['instituteid'];
                                $institute = $row['institute'];
                                if ($instituteID == $userInstitute) {
                                    echo "<option selected='selected' value='$instituteID'>$institute</option>";
                                } else {
                                    echo "<option value='$instituteID'>$institute</option>";
                                }
                            }
                        }

                       ?>

                    </select>
                  </div>
                  <div class="field" name="accounttype">
                    <label for="accounttype">Account Type:</label>

                    <div class="ui checkbox">
                      <input type="checkbox" name="buyer" value="1" id="buyerSelectioneditProfile" <?php echo "$buyerChecked" ?>>
                      <label for="buyer">Buyer</label>
                    </div>
                  </div>
                  <div class="field" name="accounttype">
                    <div class="ui checkbox">
                      <input type="checkbox" name="seller" value="2" id="sellerSelectioneditProfile" <?php echo "$sellerChecked" ?>>
                      <label for="seller">Seller</label>

                    </div>
                  </div>
                </div>
                <div class="two fields">
                  <div class="field">
                    <label for="file">Change profile picture</label>
                    <img class="ui small image" src=<?php echo "profileimgs/$userProfileImg" ?> alt="profilepicture">
                    <input type="file" class="ui button" id="editProfileImg" name="editProfileImg"></input>
                  </div>
                  <div class="field"></div>

                </div>

                <div class="ui error message"></div>
                <div class="ui success message"></div>
                <div class="item">
                  <div class="field">

                  </div>
                  <div class="field">

                    <input class="ui right floated button" name="submitedit" type="submit" id="submitEdit"></input>
                    <a class="ui right floated button" href="/elmtree/account.php">Cancel</a>

                  </div>

                </div>

              </div>
            </form>

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
