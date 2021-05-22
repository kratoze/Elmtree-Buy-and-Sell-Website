<?php
  include("connect.php");
  $categoryItems = "";
  $instituteItems = "";
  $mobileCategoryItems = "";

  $readAddType = "SELECT * FROM ET_type";
  $resultAddType = $conn->query($readAddType);
  while ($type = $resultAddType->fetch_assoc()) {
      $categoryid = $type['typeid'];
      $category = $type['type'];
      $categoryItem = "<a class='item' href = 'index.php?type=$categoryid'>$category</a>";
      $categoryItems = $categoryItems.$categoryItem;

      $mobileCategoryItem = "<div class='field'><a class='item' href = 'index.php?type=$categoryid'>$category</a></div>";
      $mobileCategoryItems = $mobileCategoryItems.$mobileCategoryItem;
  }

  // while ($type = $resultAddType->fetch_assoc()) {
  //     $mobileCategoryid = $type['typeid'];
  //     $mobileCategory = $type['type'];
  //     $mobileCategoryItem = "<div class='field'><a class='item' href = 'index.php?type=$categoryid'>$category</a></div>";
  //     $mobileCategoryItems = $mobileCategoryItems.$mobileCategoryItem;
  // }

  $readMenuInstitute = "SELECT * FROM ET_institutes";
  $resultMenuInstitute = $conn->query($readMenuInstitute);

  while ($instituteMenu = $resultMenuInstitute->fetch_assoc()) {
      $instituteMenuid = $instituteMenu['instituteid'];
      $instituteMenuName = $instituteMenu['institute'];

      $instituteItem = "<a class='item' href = 'index.php?institute=$instituteMenuid'>$instituteMenuName</a>";
      $instituteItems = $instituteItems.$instituteItem;
  }


  if (isset($_SESSION['username']) && $_SESSION['usertype'] > 1) {
      $addproduct = "<a class='item' id='addproduct' href='/elmtree/addproduct.php'>Add Product</a>";
      $mobileAddproduct = "<a class='item' id='mobileaddproduct' href='/elmtree/addproduct.php'>Add Product</a>";
  } else {
      $addproduct = "";
      $mobileAddproduct = "";
  }



  echo "<!-- ************************ SIDEBAR ************************ -->
  <div class='ui right vertical sidebar menu thin'>

    <a href='/elmtree/index.php' class='item'>Home</a>".$mobileAddproduct."
    <div class='item'>

      <!-- ************************ ACCORDIAN WITHIN SIDEBAR ************************ -->
      <div class='ui vertical accordion'>
        <a class='title item'>Categories
          <i class='counterclockwise rotated dropdown icon'></i>
        </a>

        <div class='content'>
          <div class='grouped fields'>".$mobileCategoryItems."</div>
        </div>
      </div>
      <!-- END OF ACCORDIAN -->

    </div>

    <a href='/elmtree/account.php' class='item'>Account</a>
    <a class='item' id='mobilelogout' href='/elmtree/logout.php'>Logout</a>


  </div>
  <!-- END OF SIDERBAR -->

  <!-- ************************ FIXED TOP MENU ************************ -->
  <div class='ui top fixed menu'>
    <a href='/elmtree/index.php' class='item'>
      <img id='menulogo' class='fitted' src='./images/elmtreelogo4.png' alt='elmtreelogo'>Home</img>
    </a>


    <div class='ui search item'>
    <form method='GET' action='/elmtree/index.php' >
      <div class='ui transparent icon input'>
        <input class='prompt' type='text' name='search' placeholder='Search products...'>
        </form>
        </div>
        </div>


        <div class='ui pointing dropdown link item' id='browsedropdown'>
          <span class='text'>Browse</span>
          <i class='dropdown icon'></i>
          <div class='menu'>
            <div class='item'>
              <span class='text'>Categories</span>
              <i class='dropdown icon'></i>
              <div class='menu'>".$categoryItems."</div>
            </div>
            <div class='item'>
              <span class='text'>Institutes</span>
              <i class='dropdown icon'></i>
              <div class='menu'>".$instituteItems."</div>
            </div>
          </div>
        </div>";





    if (isset($_SESSION['username'])) {
        echo "<div class='right menu'>
                <div class='item' id='#usernameprompt'>Logged in as ".$_SESSION['username']."</div>".$addproduct."
                <a class='item' id='account' href='/elmtree/account.php'>Account</a>
                <a class='item' id='logout' href='/elmtree/logout.php'>Logout</a>
                <div class='item menu-trigger' id='siderbarbutton'>
                  <i class='sidebar icon'></i>
                </div>
                </div>
              </div>
              <!-- END OF TOPMENU -->";
    } else {
        echo "<div class='right menu'>
              <a class='item' id='login' href='/elmtree/login.php'>Login</a>
              <a class='item' id='signup' href='/elmtree/signup.php'>Signup</a>
              <div class='item menu-trigger' id='siderbarbutton'>
                <i class='sidebar icon'></i>
              </div>
              </div>
            </div>
            <!-- END OF TOPMENU -->";
    }
