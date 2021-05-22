<?php
  include("connect.php");

  $totalRating = 0;
  $read = "SELECT * FROM ET_users INNER JOIN ET_products ON ET_users.userid = ET_products.userid WHERE status = 1 ";
  $result = $conn->query($read);
  $numOfSoldProducts = $result->num_rows;
  while ($row = $result->fetch_assoc()) {
      if ($row['rating'] > 0) {
          $totalRating += $row['rating'];
      }

      echo $totalRating / $numOfSoldProducts."/5";
  }
