<?php

  session_start();
  $userid = openssl_encrypt($_SESSION['usernameid'], "AES-128-ECB", $_SESSION['userkey']);

  if ($_SESSION['usertype'] < 2) {
      header("Location: index.php");
  }

  include("connect.php");
  $readType = "SELECT * FROM ET_type";
  $resultType = $conn->query($readType);

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
    $(function () {
      $('.ui.form').form({
        inline: true,
        fields: {
          name: {
            identifier: 'name',
            rules: [
              {
                type: 'empty',
                prompt: 'Please enter product name'
              }, {
                type: 'maxLength[50]',
                prompt: 'Product name is too long'
              }
            ]
          },
          price: {
            identifier: 'price',
            rules: [
              {
                type: 'empty',
                prompt: 'Please enter a price'
              }, {
                type: 'maxLength[50]',
                prompt: 'Price is too long'
              }
            ]
          },
          desc: {
            identifier: 'desc',
            field: 'textarea',
            rules: [
              {
                type: 'empty',
                prompt: 'Please enter a decription'
              }, {
                type: 'minLength[10]',
                prompt: 'Description must be at least 10 characters'
              }
            ]
          },
          category: {
            identifier: 'type',
            rules: [
              {
                type: 'empty',
                prompt: 'Please choose a category'
              }
            ]
          },
        }

      })

    });
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
            <div class="ui twelve wide column"></div>
            <div class="ui two wide column"></div>

          </div>
          <div class="row">
            <div class="ui two wide column"></div>
            <div class="ui twelve wide column">
              <form method="POST" action="<?php echo "processaddproduct.php?userid=$userid" ?>" class="ui equal width form" enctype="multipart/form-data">
                <div class="fields">
                  <div class="field">
                    <label for="name">Product name</label>
                    <input type="text" name="name" id="productName">
                  </div>
                  <div class="field">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="productPrice" step="0.01" min="0">
                  </div>
                </div>
                <div class="field">
                  <label for="decription"></label>
                  <textarea name="desc" id="productDesc">Product description...</textarea>
                </div>
                <div class="field">

                  <label for="type">Category</label>
                  <select name="type" id="productCategory" class="fluid dropdown">
                  <?php


                      if (!$resultType) {
                          echo $conn->error;
                      } else {
                          while ($row = $resultType->fetch_assoc()) {
                              $typeID= $row['typeid'];
                              $type = $row['type'];

                              echo "<option value='$typeID'>$type</option>";
                          }
                      }

                     ?>

                  </select>
                </div>
                <div class="field">
                  <label for="file">Product image</label>
                  <input type="file" class="ui button" id="productImg" name="productImg"></input>
                </div>
                <div class="field">
                  <label for="file">Secondary images</label>
                  <input type="file" class="ui button" id="productImg" name="gallery[]" multiple></input>
                </div>

                <button class="ui right floated button submit" type="submit">Submit</button>
              </form>
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
