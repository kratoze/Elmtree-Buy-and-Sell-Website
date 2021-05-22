<?php
  session_start();
  include("connect.php");

  $sellerid = $_GET['sellerid'];
  $rating = $_POST['rate'];


  $currentRatingRead = "SELECT rating FROM ET_users WHERE userid = '$sellerid'";
  $currentRatingResult = $conn->query($currentRatingRead);
  $currentRatingFetch = $currentRatingResult->fetch_assoc();
  $currentRating = $currentRatingFetch['rating'];

  $newRating = $currentRating + $rating;

  $updateRating = "UPDATE ET_users SET rating = '$newRating' WHERE userid = '$sellerid'";

  $updateRatingQuery = $conn->query($updateRating);

  if ($updateRatingQuery) {
      header("Location: /elmtree/boughtitems.php");
  } else {
      echo "Update failed ".$conn->error;
      header("Location: /elmtree/boughtitems.php");
  }
