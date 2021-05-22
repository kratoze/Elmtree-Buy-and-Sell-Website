<?php

  //header('Location: ./login.php');

  include("connect.php");

      $signupUsername = $conn->real_escape_string(trim($_POST['username']));
      $signupPassword = $conn->real_escape_string(trim($_POST['password']));
      $signupFirstName = $conn->real_escape_string(trim($_POST['firstname']));
      $signupLastName = $conn->real_escape_string(trim($_POST['lastname']));
      $signupEmail = $conn->real_escape_string(trim($_POST['email']));
      $signupPhoneNumber = $conn->real_escape_string(trim($_POST['phonenumber']));
      $signupInstitute = $conn->real_escape_string(trim($_POST['institute']));
      $signupSeller = $_POST['seller'];
      $signupBuyer = $_POST['buyer'];
      $signupPic = $_FILES['signupImg']['name'];
      $signupPicTemp = $_FILES['signupImg']['tmp_name'];
      $picName = rand(1000, 100000).$signupPic;

      $accountroleInsert;
      $signupInsert = "INSERT INTO ET_users(username,
                                        forename,
                                        surname,
                                        password,
                                        email,
                                        phonenumber,
                                        institute,
                                        profileimg)
                      VALUES ('$signupUsername',
                              '$signupFirstName',
                              '$signupLastName',
                              '$signupPassword',
                              '$signupEmail',
                              '$signupPhoneNumber',
                              '$signupInstitute',
                              '$picName')";

      $conn->autocommit(false);

      $signupResult = $conn->query($signupInsert);
      $signupID = $conn->insert_id;

      if ($signupSeller > 0) {
          $sellerInsert = "INSERT INTO ET_users_role(userid, roleid)
                          VALUES ('$signupID', '$signupSeller')";
          $sellerResult = $conn->query($sellerInsert);
      }

      if ($signupBuyer > 0) {
          $buyerInsert = "INSERT INTO ET_users_role(userid, roleid)
                          VALUES ('$signupID', '$signupBuyer')";
          $buyerResult = $conn->query($buyerInsert);
      }



      if ($conn->commit()) {
          $move = move_uploaded_file($signupPicTemp, "profileimgs/$picName");
          echo 'successful';
          if (!$move) {
              echo "Not uploaded because of error ".$_FILES['signupImg']['error'];
          }
      } else {
          $conn->rollback();
          echo "sign up failed";
      }



      //
      // if (!$signupResult) {
      //     echo $conn->error;
      // } else {
      //     echo "account role: ".$signupAccountrole;
      //     echo "It worked!";
      // }
