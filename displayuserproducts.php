<?php

  include("connect.php");
  $userid = $_SESSION['usernameid'];
  $readUserProducts = "SELECT * FROM ET_products WHERE userid = '$userid'";
  $resultUserProducts = $conn->query($readUserProducts);
  $soldTag = "";

  while ($userProducts = $resultUserProducts->fetch_assoc()) {
      $productID = $userProducts['productid'];
      $productID = openssl_encrypt($productID, "AES-128-ECB", $_SESSION['userkey']);

      $productName = $userProducts['productname'];
      $productDesc = $userProducts['productdesc'];
      $productPrice = $userProducts['price'];
      $productTypeID = $userProducts['type'];
      $mainImg = $userProducts['mainimg'];
      $dateAdded = $userProducts['dateadded'];
      $productStatus = $userProducts['status'];
      $dateAdded = date('d-m-Y', strtotime($dateAdded));

      if ($productStatus == 1) {
          $soldTag = "<b>Sold</b>";
      }

      echo "<div class='row productRow'>
              <div class='ui two wide column'></div>
              <div class='ui twelve wide column productitem'>
                <div class='ui stackable relaxed grid'>
                <div class='row'>
                  <div class='four wide column'>
                    <img class='ui fluid image productimg' src='productimgs/$mainImg' alt='$productName'></img>
                  </div>
                  <div class='eight wide column'>
                    <div class='column'>

                      <div class='row'>
                        <h3>$productName</h3>
                      </div>
                      <div class='row'>
                        <div class='column'>$productDesc</div>

                      </div>
                      <div class='row'></div>
                    </div>
                  </div>
                  <div class='right floated right aligned four wide column'>
                  <div class='row productprice'>
                  <b>&pound$productPrice</b>
                  </div>
                  <div class='row''>
                    added: $dateAdded
                  </div>
                  <div class='row'>
                    $soldTag
                  </div>
                  <div class='row edit'>
                    <a class='ui right floated button' href='editproduct.php?productid=$productID'>Edit</a>
                    <a class='ui right floated button' href='deleteproduct.php?productid=$productID'>Delete</a>
                  </div>

                  </div>
                </div>

              </div>
              </div>
              <div class='ui two wide column'></div>
              </div>";
  }
