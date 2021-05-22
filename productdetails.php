<?php
session_start();
include("connect.php");
$productid = $_GET['productid'];

$productRead = "SELECT *, ET_type.type AS category FROM ET_products INNER JOIN ET_type ON ET_products.type=ET_type.typeid WHERE productid ='$productid'";

$resultProduct = $conn->query($productRead);
$product = $resultProduct->fetch_assoc();
$sellerID = $product['userid'];
$productStatus = $product['status'];
$productID = $product['productid'];
$productName = $product['productname'];
$productDesc = $product['productdesc'];
$productPrice = $product['price'];
$productTypeID = $product['type'];
$mainImg = $product['mainimg'];
$dateAdded = $product['dateadded'];
$category = $product['category'];

$sellerRead = "SELECT * FROM ET_users WHERE userid ='$sellerID'";
$sellerResult = $conn->query($sellerRead);
$seller = $sellerResult->fetch_assoc();
$sellerUsername = $seller['username'];
$sellerFirstName = $seller['forename'];
$sellerLastName = $seller['surname'];
$sellerPic = $seller['profileimg'];
$sellerEmail = $seller['email'];

$sellerID = openssl_encrypt($sellerID, "AES-128-ECB", $_SESSION['userkey']);
$productID = openssl_encrypt($productID, "AES-128-ECB", $_SESSION['userkey']);
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

  </head>
  <body>
    <?php
      include("topmenu.php");
     ?>

    <div class="pusher">
      <div class="ui fluid container">
        <div class="ui grid">
          <div class="ui two wide column"></div>
          <div class="ui twelve wide column productitem">

            <div class="ui relaxed grid">
              <div class="row gallery">

              <div class="four wide column">
                <img class="ui medium image" src=<?php echo "/elmtree/productimgs/$mainImg" ?> alt=<?php echo "$productName" ?>>
              </div>

              <?php
                $readGallery = "SELECT * FROM ET_productgallery
                                INNER JOIN ET_products
                                ON ET_productgallery.productid = ET_products.productid
                                WHERE ET_productgallery.productid = '$productid'";

                $resultGallery = $conn->query($readGallery);

                if ($resultGallery) {
                    while ($img = $resultGallery->fetch_assoc()) {
                        $imgPath = $img['imgpath'];

                        echo "<div class='four wide column'>
                          <img class='ui medium image' src='/elmtree/productimgs/$imgPath' alt='$productName'>
                        </div>";
                    }
                }
               ?>

            </div>


              <div class="sixteen wide column">
                <div class="column">
                  <div class="row">
                    <h3><?php echo "$productName" ?></h3>

                  </div>
                  <div class="row">
                    <div class="column">
                      <?php echo "$productDesc" ?>
                    </div>
                    <div class="row">
                      <div class="ui equal width grid">
                        <div class="column">
                          <b><?php echo $product['category'] ?></b>
                        </div>
                        <div class="right floated right aligned column">
                          <b>&pound<?php echo "$productPrice" ?></b>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="ui equal width grid">

              <div class='row'>
                <div class="ui right floated right aligned column">
                  <a class='ui button ui right aligned' href=<?php echo "/elmtree/buyproduct.php?productid=".$productID ?>>Buy</a>

                </div>
              </div>

            </div>

          </div>
          <div class="ui two wide column"></div>

          <div class="row">
            <div class="ui eight wide column"></div>
            <div class="ui six wide column userinfo">
              <div class="ui stackable grid right floated left aligned">
                  <div class="three wide column">
                    <h4>Seller:</h4>
                  </div>
                <div class="five wide column">
                  <div class="row">
                    <?php echo "$sellerFirstName"." "."$sellerLastName" ?>


                  </div>
                  <div class="row">
                    <?php echo "$sellerUsername" ?>


                  </div>

                </div>
                <div class="three wide column">
                  <img class="ui left floated circular tiny image" src=<?php echo "/elmtree/profileimgs/$sellerPic" ?> alt="Seller Picture">
                </div>
                <div class="four wide column">
                    <div class="row">
                      <?php include("calculaterating.php") ?>
                    </div>
                    <div class="row">
                      <a href=<?php echo "mailto:".$sellerEmail ?>>Contact</a>
                    </div>
                </div>

              </div>
            </div>

            <div class="ui five wide column"></div>
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
