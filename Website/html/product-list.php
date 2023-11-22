<?php 
  // You can now use $product in your code
  session_start();
  $Cat = isset($_POST['Category']) ? $_POST['Category'] : '';
  function products($sortPrice, $sortName, $Cat)
  {
    
    
    //print_r($Cat);
      // Set session variables
      $serverName = $_SESSION["serverName"];
		$connectionOptions = $_SESSION["connectionOptions"];
      $conn = sqlsrv_connect($serverName, $connectionOptions);

      if($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if($Cat == 'Accessories'){
      $tsql = "{call spProducts}";
      $getResults = sqlsrv_query($conn, $tsql);
    }else{
      $tsql = "{call spProduct (?)}";
      $params = array($Cat); // replace 'Electronics' with the category you want

      $getResults = sqlsrv_query($conn, $tsql, $params);
    }

      
    //$tsql = "SELECT  TOP 30 C.* FROM [dbo].[PRODUCT] AS C";
    //$getResults = sqlsrv_query($conn, $tsql);
      while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
          $data[] = $row;
      }

      if($sortPrice == 1){
      usort($data, function($a, $b) {
        if ($a['Price'] == $b['Price']) {
          return 0;
        }
        return ($a['Price'] < $b['Price']) ? -1 : 1;
      });
    }else if($sortPrice == -1){
      usort($data, function($a, $b) {
        if ($a['Price'] == $b['Price']) {
          return 0;
        }
        return ($a['Price'] > $b['Price']) ? -1 : 1;
      });
    }

    if($sortName == 1){
      usort($data, function($a, $b) {
        return strcmp($a['Product_Name'], $b['Product_Name']);
      });
    }else if($sortName == -1){
      usort($data, function($a, $b) {
        return strcmp($b['Product_Name'], $a['Product_Name']);
      });
    }

      foreach ($data as $product) {
        // Iterate over each column in the row
       
        // Print the column name and value

        $name = $product['Product_Name'];
        $arg = str_replace("&", " AND ", $name);
        $price = $product['Price'];
        $image = $product['Image_path'];

        echo "<div class='col-lg-3 col-sm-6'>
        <div class='product_box'>
           <img src='$image' class='prImage'>
           <h4 class='bursh_text'>$name</h4>
           <div class='btn_main'>
              <div class='buy_bt'>
                 <form id='detailForm_$arg' method='post' action='product-detail.php' style='display: none;'>
                   <input type='hidden' name='Name' value='$arg'>
                   <input type='hidden' name='Category' value='$Cat'>
                 </form>
                 <a href='#' onclick='document.getElementById(\"detailForm_$arg\").submit();'>View</a>
              </div>
              <h3 class='price_text'>Price €$price</h3>
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
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.15;
        color: var(--dl-color-gray-black);
        background-color: var(--dl-color-gray-white);

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
              <a href="index.php" class="product-list-nav1">Home</a>
              <a href="products.php" class="product-list-nav2">Products</a>
              <span class="product-list-nav3">Order</span>
              <div class="product-list-nav4">
                <span class="products-text">Cart</span>
                <br />
              </div>
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
        <form method="post" id="sortForm">
  <input type="hidden" name="Category" value="<?php echo $Cat?>">
  <input type="radio" id="option1" name="optionP" value="1" onchange="document.getElementById('sortForm').submit()">
  <label for="option1">Sort by Price ASC</label><br>
  <input type="radio" id="option2" name="optionP" value="-1" onchange="document.getElementById('sortForm').submit()">
  <label for="option2">Sort by Price DESC</label><br>
  <input type="radio" id="option3" name="optionN" value="1" onchange="document.getElementById('sortForm').submit()">
  <label for="option3">Sort by Name ASC</label><br>
  <input type="radio" id="option4" name="optionN" value="-1" onchange="document.getElementById('sortForm').submit()">
  <label for="option4">Sort by Name DESC</label><br>
</form>
        <div class="product-list-container2">
          <div class="row">

          <?php 
      $optionP = isset($_POST['optionP']) ? $_POST['optionP'] : 0;
      $optionN = isset($_POST['optionN']) ? $_POST['optionN'] : 0;
      products($optionP,$optionN, $Cat); 
      
    ?> 
        </div>
      </div>
      </div>
    </div>
    
  </body>
</html>
