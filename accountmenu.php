<?php

$menuOption = "";
$boughtItems = "";
$soldItems = "";
$editHeader = "";
if ($_SESSION['usertype'] == 1) {
    $boughtItems = "<a class='item button' href='boughtitems.php'>Bought products</a>";
}
if ($_SESSION['usertype'] > 2) {
    $editHeader = "Choose a product to edit:";
    $boughtItems = "<a class='item button' href='boughtitems.php'>Bought products</a>";
}
// if ($_SESSION['usertype'] > 3) {
//     $editHeader = "Choose a product to edit:";
//     $boughtItems = "<a class='item button' href='boughtitems.php'>Bought products</a>";
// }

$menuOption = $boughtItems.$soldItems;

echo "<div class='ui fluid three item secondary menu'>
        <a class='item button' href='/elmtree/editprofile.php?userid='.$userid'>Edit Profile</a>".$menuOption."
      </div>";
