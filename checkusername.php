<?php
  include("connect.php");

  $usernameToCheck = $_POST['username'];

  $readCheckUsername = "SELECT COUNT(*) AS duplicates FROM ET_users WHERE username = '$usernameToCheck'";
  $resultCheckUsername = $conn->query($readCheckUsername);
  $rowsToCheck = $resultCheckUsername->fetch_assoc();
  $numberOfDuplicates = $rowsToCheck['duplicates'];


  echo $numberOfDuplicates;

//     $rowsToCheck = $resultCheckUsername->fetch_assoc();
//     $numberOfDuplicates = $rowsToCheck['duplicates'];






  // if ($numberOfDuplicates > 0) {
  //     echo "false";
  // } else {
  //     echo "true";
  // }
