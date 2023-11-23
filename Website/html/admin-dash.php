<?php

// You can now use $product in your code
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'delete') {
  $pid = $_POST['pid']; // Get the product ID from the form
  deleteProduct($pid);  // Call your function with the product ID
}
function deleteProduct($pid)
{
  $serverName = $_SESSION["serverName"];
  $connectionOptions = $_SESSION["connectionOptions"];
  $conn = sqlsrv_connect($serverName, $connectionOptions);

  if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
  }
  $tsql = "{call spDeleteProduct (?)}";
  $params = array($pid); // replace 'Electronics' with the category you want
  sqlsrv_query($conn, $tsql, $params);

}
function products()
{


  //print_r($Cat);
  // Set session variables
  $serverName = $_SESSION["serverName"];
  $connectionOptions = $_SESSION["connectionOptions"];
  $conn = sqlsrv_connect($serverName, $connectionOptions);

  if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
  }


  $tsql = "{call spAllProducts}";
  $getResults = sqlsrv_query($conn, $tsql);

  //$tsql = "SELECT  TOP 30 C.* FROM [dbo].[PRODUCT] AS C";
  //$getResults = sqlsrv_query($conn, $tsql);
  while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
  }


  foreach ($data as $product) {
    // Iterate over each column in the row

    // Print the column name and value
    $pid = $product['Product_ID'];
    $name = $product['Product_Name'];
    $price = $product['Price'];
    $quantity = $product['Stock'];
    $image = $product['Image_path'];

    echo "<div class='row'>
            <div class='col'>
                <div class='card'>
                    <div class='admin-edit1-product'>
                        <div class='admin-edit1-product'>
                            <span class='admin-edit1-name'>
                              <span>PID</span>
                              <br />
                            </span>
                            <span class='admin-edit1-name1'>
                              <span>Name</span>
                              <br />
                            </span>
                            <span class='admin-edit1-price'>Price</span>
                            <span class='admin-edit1-name-placeholder'>$pid</span>
                            <div class='admin-edit1-name-placeholder1'>
                            <p>$name</p>
                            </div>
                            <span class='admin-edit1-price-placeholder'>$price</span>
                            <span class='admin-edit1-quantity-placeholder'>$quantity</span>
                            <span class='admin-edit1-quantity'>
                              <span>Quantity</span>
                              <br />
                            </span>
                              <img
                                alt='image'
                                src='$image'
                                class='admin-edit1-product-img'
                              />
                            </a>
                            <form method='POST'>
                            <input type='hidden' name='action' value='delete'>
                            <input type='hidden' name='pid' value='$pid'>
                            <button type='submit' class='admin-edit1-button button'>Delete</button>
                            </form>
                            <form action='AdminForm.php' method='POST'>
                            <input type='hidden' name='pid' value='$pid'>
                            <button type='submit' class='admin-edit1-button1 button'>
                            <span>
                            <span>Edit</span>
                            <br />
                            </span>
                            </button>
                            </form>
                          </div>
                    </div>
                </div>
            </div>
        </div>";

  }

  /* Free query  resources. */
  sqlsrv_free_stmt($getResults);

  /* Free connection resources. */
  sqlsrv_close($conn);

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>my-ecigshop</title>
    <meta
      property="og:title"
      content="my-ecigshop"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    
    <link rel="stylesheet" type="text/css" href="admin-dash.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <style data-tag="reset-style-sheet">
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
    </style>
    <style data-tag="default-style-sheet">
      html {
        font-family: Inter;
        font-size: 16px;
      
      }

      body {
        font-weight: 400;
        background-color: #D9D9D9;
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.15;
        color: var(--dl-color-gray-black);
      

      }
    </style>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <style>
      @keyframes fade-in-left {
        0% {
          opacity: 0;
          transform: translateX(-20px);
        }
        100% {
          opacity: 1;
          transform: translateX(0);
        }
      }
    </style>
  </head>
  <body>
    <link rel="stylesheet" href="./style.css" />
    <div>
      <link href="./admin-dash.css" rel="stylesheet" />
      <link href="./product-list.css" rel="stylesheet" />
      <div class="product-list-container">
        <div class="product-list-header">
          <header data-thq="thq-navbar" class="product-list-navbar-interactive">
            <img
              alt="image"
              src="./Images/MyEcigShopLogoNew.png"
              class="product-list-image"
            />
            <nav class="product-list-links">
            <a href="index.html" class="product-list-nav1">Product List</a>
            <a href="products.html" class="product-list-nav2">Add Items</a>
              
              
              <span class="product-list-nav5"></span>
            </nav>
            <div class="product-list-container1">
              <div
                data-thq="thq-navbar-nav"
                class="product-list-desktop-menu"
              ></div>
            </div>
            
            
          </header>
        </div>

             
                <div class="admin-edit1-list-container">

                    <div class="container">
                    <?php products(); ?>
                        
                    </div>
                  </div>
             

        </div>
      </div>
      </div>
    </div>
    
  </body>
</html>
