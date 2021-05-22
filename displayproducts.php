<?php
  include('connect.php');

  $productSearch = "";

  if (isset($_GET['type'])) {
      $typeid = $_GET['type'];
      $typeSearch = "WHERE ET_products.type ='$typeid'";
  } else {
      $typeSearch = "";
  }
  if (isset($_GET['institute'])) {
      $searchInstituteid = $_GET['institute'];
      $searchInstitute = "WHERE institute = '$searchInstituteid'";
  } else {
      $searchInstitute = "";
  }
  if (isset($_GET['search'])) {
      $searchQuery = trim($_GET['search']);
      $productSearch = "WHERE productname LIKE '%$searchQuery%' OR ET_type.type LIKE '%$searchQuery%'";
  } else {
      $productSearch = "";
  }


  $readInstitute = "SELECT * FROM ET_institutes";

  $readTotalInstitutes = "SELECT COUNT(*) AS total FROM ET_institutes";
  $resultInstitute = $conn->query($readInstitute);
  $resultTotalInstitutes = $conn->query($readTotalInstitutes);
  $totalInstitutes = $resultTotalInstitutes->fetch_assoc();

  $readProducts = "SELECT * FROM ET_products LEFT JOIN ET_type ON ET_products.type = ET_type.typeID INNER JOIN
                                              (SELECT * FROM ET_users) as x
                                                ON ET_products.userid = x.userid ".$typeSearch." ".$searchInstitute." ".$productSearch;

  $resultProducts = $conn->query($readProducts);


  if (!$resultProducts) {
      echo $conn->error;
  } else {
      while ($row = $resultProducts->fetch_assoc()) {
          $productStatus = $row['status'];
          if ($productStatus == 1 || $productStatus == 2) {
              continue;
          }
          $productID = $row['productid'];
          $productName = $row['productname'];
          $productDesc = $row['productdesc'];
          $productPrice = $row['price'];
          $productTypeID = $row['type'];
          $mainImg = $row['mainimg'];
          $dateAdded = $row['dateadded'];

          $readProductType = "SELECT type FROM ET_type WHERE ET_type.typeid = ET_producttype.type";
          $resultProductType = $conn->query($readProductType);
          //  $productTypes = $resultProductType->fetch_assoc();
          //  $productType = $productTypes['type'];

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
                        <a class='ui button ui right aligned details' href='productdetails.php?productid=$productID'>More details</a>

                      </div>

                      </div>
                    </div>

                  </div>
                  <div class='ui two wide column'></div>

                </div>";
      }
  }
