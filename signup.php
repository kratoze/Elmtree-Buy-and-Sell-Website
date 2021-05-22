<?php
  include("connect.php");
  $readInstitute = "SELECT * FROM ET_institutes";
  $readTotalInstitutes = "SELECT COUNT(*) AS total FROM ET_institutes";
  $resultInstitute = $conn->query($readInstitute);
  $resultTotalInstitutes = $conn->query($readTotalInstitutes);
  $totalInstitutes = $resultTotalInstitutes->fetch_assoc();

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

        $('#submitSignup').click(function (e) {

          e.preventDefault();

          $('.ui.form').form('validate form');

          if ($('.ui.form').form('is valid')) {

            var form = document.getElementById('signupForm');

            $.ajax({
              type: 'POST',
              url: 'processsignup.php',
              data: new FormData(form),
              processData: false,
              contentType: false,
              success: function (data, response, value) {
                console.log(response)
                if (response == "success") {
                  console.log("Signup successful");
                  var firstname = $("#firstNameSignup").val();
                  var lastname = $("#lastNameSignup").val();

                  $('#submitSignup').addClass('disabled');
                  $(".ui.success.message").html("Thank you " + firstname + " " + lastname + " for registering. " + "<a href='/elmtree/login.php'>Login</a>");
                } else {
                  $(".ui.error.message").html("Something has gone wrong please try again");
                }

              }
            });

          }

        });

        $.fn.form.settings.rules.isUsernameTaken = function (username, isUsernameTaken) {
          var username = $('#usernameSignup').val();
          var usernameIsUnique;
          $.ajax({
            type: 'POST',
            url: 'checkusername.php',
            data: "username=" + username,
            async: false,
            success: function (response) {
              if (response > 0) {
                console.log("JS: FALSE");

                //console.log(username);
                usernameIsUnique = false;
              } else if (response == 0) {
                console.log("JS: TRUE");

                //console.log(username);

                usernameIsUnique = true;
              }
            }
          });
          return usernameIsUnique;
        }

        $.fn.form.settings.rules.isAccountType = function (value, param) {
          if ($('#buyerSelectionSignup').is(':checked') || $('#sellerSelectionSignup').is(':checked')) {
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
                  }, {
                    type: 'isUsernameTaken[username]',
                    prompt: "This username is already taken"

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
              <form method="POST" id="signupForm" action="" enctype="multipart/form-data" class="ui form">
                <div class="field">
                  <label for="firstname">Name</label>
                  <div class="two fields">
                    <div class="field">
                      <input type="text" id="firstNameSignup" name="firstname" placeholder="first name">
                    </div>
                    <div class="field">
                      <input type="text" id="lastNameSignup" name="lastname" placeholder="last name">
                    </div>

                  </div>
                </div>
                <div class="field">
                  <div class="two fields">
                    <div class="field">
                      <label for="username">Username</label>

                      <input type="text" id="usernameSignup" name="username" placeholder="username">
                    </div>

                    <div class="field">
                      <label for="password">Password</label>

                      <input type="password" id="passwordSignup" name="password" placeholder="password">
                    </div>
                  </div>
                </div>
                <div class="field">
                  <label for="email">Email</label>

                  <input type="text" id="emailSignup" name="email" placeholder="email">
                </div>

                <div class="field">
                  <label for="phoneNumber">Phone Number</label>

                  <input type="number" id="phoneNumberSignup" name="phonenumber" placeholder="phone number">
                </div>

                <div class="inline fields stackable">

                  <div class="field">

                    <label for="institute">Institute</label>
                    <select name="institute" id="instituteSignup" class="fluid dropdown">
                    <?php


                        if (!$resultInstitute) {
                            echo $conn->error;
                        } else {
                            while ($row = $resultInstitute->fetch_assoc()) {
                                $instituteID = $row['instituteid'];
                                $institute = $row['institute'];

                                echo "<option value='$instituteID'>$institute</option>";
                            }
                        }

                       ?>

                    </select>
                  </div>
                  <div class="field" name="accounttype">
                    <label for="accounttype">Account Type:</label>

                    <div class="ui checkbox">
                      <input type="checkbox" name="buyer" value="1" id="sellerSelectionSignup">
                      <label for="buyer">Buyer</label>
                    </div>
                  </div>
                  <div class="field" name="accounttype">
                    <div class="ui checkbox">
                      <input type="checkbox" name="seller" value="2" id="buyerSelectionSignup">
                      <label name="buyerlabel" for="seller">Seller</label>

                    </div>
                  </div>
                </div>
                <div class="two fields">
                  <div class="field">
                    <label for="file">Choose a profile picture</label>
                    <input type="file" class="ui button" id="signupImg" name="signupImg"></input>
                  </div>
                  <div class="field"></div>

                </div>

                <div class="ui error message"></div>
                <div class="ui success message"></div>
                <div class="field">

                  <input class="ui right floated button" name="submitsignup" type="submit" id="submitSignup"></input>
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
