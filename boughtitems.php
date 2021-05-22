<?php
session_start();
include("connect.php");

$userid = $_SESSION['usernameid'];

$readProducts = "SELECT *, ET_products.userid AS sellerid FROM ET_products INNER JOIN ET_boughtproducts ON ET_products.productid = ET_boughtproducts.productid WHERE ET_boughtproducts.userid = '$userid'";

$resultProducts = $conn->query($readProducts);





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
      $(document).ready(function () {});
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
              <?php include("accountmenu.php") ?>
            </div>
            <div class="ui two wide column"></div>

          </div>
          <div class="row">
            <div class="ui two wide column"></div>
            <div class="ui twelve wide column">
              <h3>Purchase History</h3>
            </div>
            <div class="ui two wide column"></div>

          </div>


          <div class="row">
            <div class="ui two wide column"></div>
            <div class="ui twelve wide column">
              <?php if (!$resultProducts) {
        echo "<h3>You have not made any purches yet</h3>";
    } else {
        while ($row = $resultProducts->fetch_assoc()) {
            $sellerid = $row['sellerid'];
            $productID = $row['productid'];
            $productName = $row['productname'];
            $productDesc = $row['productdesc'];
            $productPrice = $row['price'];
            $productTypeID = $row['type'];
            $mainImg = $row['mainimg'];
            $dateAdded = $row['dateadded'];


            echo "<div class='row productRow'>
                                 <div class='ui two wide column'></div>
                                 <div class='ui twelve wide column productitem'>
                                   <div class='ui stackable grid'>
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
                                     <div class='row details'>
                                       <form method='POST' action='processrating.php?sellerid=$sellerid'>
                                         <label for='rating'>Rate this purchase</label>
                                         <select name='rate' class='fluid dropdown' onchange='this.form.submit()'>
                                           <option value='1'>1</option>
                                           <option value='2'>2</option>
                                           <option value='3'>3</option>
                                           <option value='4'>4</option>
                                           <option value='5'>5</option>

                                         </select>

                                     </div>

                                     </div>
                                   </div>

                                 </div>
                                 <div class='ui two wide column'></div>

                               </div>";
        }
    }

                     ?>
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
