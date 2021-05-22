<?php
session_start();
include("connect.php");

$productID = openssl_decrypt($_GET['productid'], "AES-128-ECB", $_SESSION['userkey']);

$readDelete = "DELETE FROM ET_products WHERE productid ='$productID'";

$resultDelete = $conn->query($readDelete);

header("Location: /elmtree/account.php");
