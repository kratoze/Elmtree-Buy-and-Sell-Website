<?php
  session_start();
  $productid = openssl_decrypt($_GET['productid'], "AES-128-ECB", $_SESSION['userkey']);

  include("connect.php");
  $newProductName = $conn->real_escape_string(trim($_POST['name']));
  $newProductPrice = $conn->real_escape_string(trim($_POST['price']));
  $newProductDesc = $conn->real_escape_string(trim($_POST['desc']));
  $newProductType = $conn->real_escape_string(trim($_POST['type']));
  $hideProduct = isset($_POST['hidden']) ? 2 : 3;

  $newProductImg = $_FILES['productImg']['name'];
  $newProductImgTemp = $_FILES['productImg']['tmp_name'];

  $updateProduct =  "UPDATE ET_products SET
                                        productname = '$newProductName',
                                        productdesc = '$newProductDesc',
                                        price = '$newProductPrice',
                                        type = '$newProductType',
                                        status = '$hideProduct'
                                        WHERE productid = '$productid'";

  if (!empty($newProductImg)) {
      $newProductImgName = rand(1000, 100000).$newProductImg;
      $updateImg = "UPDATE ET_products SET mainimg = '$newProductImg' WHERE productid='$productid'";

      $move = move_uploaded_file($newProductImgTemp, "productimgs/$newProductImgName");
      $updateImgQuery = $conn->query($updateImg);
      if ($updateImgQuery && $move) {
      } else {
          $editProductFeedback = $conn->error." Not uploaded because of error ".$_FILES['newProductImg']['error'];
      }
  }

  $totalFiles = count($_FILES['gallery']['name']);

  if ($totalFiles > 0) {
      for ($i = 0; $i < $totalFiles; $i++) {
          $galleryImg = $_FILES['gallery']['name'][$i];
          $galleryImg = rand(1000, 100000).$galleryImg;

          $galleryImgTemp = $_FILES['gallery']['tmp_name'][$i];
          $move = move_uploaded_file($galleryImgTemp, "productimgs/$galleryImg");

          $insertGallery = "INSERT INTO ET_productgallery (productid, imgpath)
                                    VALUES ('$productid', '$galleryImg')";

          $galleryQuery = $conn->query($insertGallery);
          if (!$galleryQuery) {
              $addProductFeedback = "Not uploaded because of error ".$_FILES['gallery']['error'][$i];
          }
      }
  }

  $updateProductQuery = $conn->query($updateProduct);

  if ($updateProductQuery) {
      $editProductFeedback = "Product successfully updated ";
  } else {
      $editProductFeedback = "Update failed ".$conn->error;
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
                <?php echo "<h3>$editProductFeedback</h3>" ?>
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
