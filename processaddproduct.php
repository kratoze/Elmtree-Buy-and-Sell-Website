<?php
session_start();
include("connect.php");

$addProductFeedback = "";

$productName = $conn->real_escape_string(trim($_POST['name']));
$productPrice = $conn->real_escape_string(trim($_POST['price']));
$productDesc = $conn->real_escape_string(trim($_POST['desc']));
$productType = $conn->real_escape_string(trim($_POST['type']));
$userid = $_GET['userid'];
$userid = $_SESSION['usernameid'];
$productImg = $_FILES['productImg']['name'];
$productImgTemp = $_FILES['productImg']['tmp_name'];

$productImgName = rand(1000, 100000).$productImg;


$productInsert = "INSERT INTO ET_products(productname,
                                        productdesc,
                                        price,
                                        type,
                                        mainimg,
                                        userid)
                  VALUES ('$productName',
                          '$productDesc',
                          '$productPrice',
                          '$productType',
                          '$productImgName',
                          '$userid')";



if ($userid == $_SESSION['usernameid']) {
    $productResult = $conn->query($productInsert);
} else {
    echo "You are not authorised to do this";
}

if ($productResult) {
    $productid = $conn->insert_id;
    $move = move_uploaded_file($productImgTemp, "productimgs/$productImgName");

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

    if (!$move) {
        $addProductFeedback = "Not uploaded because of error ".$_FILES['productImg']['error'];
    } else {
        $addProductFeedback = 'Product successfully added';
    }
} else {
    $addProductFeedback = "Product could not be added";
}

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
          <div class="row">
            <div class="ui two wide column"></div>
            <div class="ui twelve wide column">
              <?php echo "<h3>$addProductFeedback</h3>" ?>
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
  </html>
