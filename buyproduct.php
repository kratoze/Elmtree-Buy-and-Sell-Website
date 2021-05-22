<?php
session_start();
include("connect.php");

if (!isset($_SESSION['username'])) {
    header("Location: /elmtree/login.php");
}
$productID = $_GET['productid'];
$productID = openssl_decrypt($productID, "AES-128-ECB", $_SESSION['userkey']);
$userid = $_SESSION['usernameid'];
$boughtItemsInsert = "INSERT INTO ET_boughtproducts (userid, productid)
                      VALUES ('$userid',
                              '$productID')";

$productUpdate = "UPDATE ET_products SET status = '1' WHERE productid = '$productID'";

$boughtItemsQuery = $conn->query($boughtItemsInsert);
$productBoughtQuery = $conn->query($productUpdate);

if ($boughtItemsQuery && $productBoughtQuery) {
    header("Location: /elmtree/boughtitems.php");
} else {
    echo $conn->error;
}
