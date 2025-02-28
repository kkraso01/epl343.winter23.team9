<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $sqlDBname = "DB";
  $serverName = $_SESSION["serverName"] = "DESKTOP-HQM94Q5";
  $_SESSION["serverName"] = "DESKTOP-HQM94Q5\MSSQLSERVER01";
  $_SESSION["connectionOptions"] = array(
          "Database" => $sqlDBname
      );
      //$conn = sqlsrv_connect($serverName, $connectionOptions);

      //if($conn === false) {
      //  die(print_r(sqlsrv_errors(), true));
    //}
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <title>my-ecigshop</title>
    <meta property="og:title" content="my-ecigshop" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />

    <style data-tag="reset-style-sheet">
      html {
        line-height: 1.15;
      }

      body {
        margin: 0;
      }

      * {
        box-sizing: border-box;
        border-width: 0;
        border-style: solid;
      }

      p,
      li,
      ul,
      pre,
      div,
      h1,
      h2,
      h3,
      h4,
      h5,
      h6,
      figure,
      blockquote,

      figcaption {
        margin: 0;
        padding: 0;
      }

      button {
        background-color: transparent;
      }

      button,
      input,
      optgroup,
      select,

      textarea {
        font-family: inherit;
        font-size: 100%;
        line-height: 1.15;
        margin: 0;
      }

      button,
      select {
        text-transform: none;
      }

      button,
      [type="button"],
      [type="reset"],
      [type="submit"] {
        -webkit-appearance: button;
      }

      button::-moz-focus-inner,
      [type="button"]::-moz-focus-inner,
      [type="reset"]::-moz-focus-inner,
      [type="submit"]::-moz-focus-inner {
        border-style: none;
        padding: 0;
      }

      button:-moz-focus,
      [type="button"]:-moz-focus,
      [type="reset"]:-moz-focus,
      [type="submit"]:-moz-focus {
        outline: 1px dotted ButtonText;
      }

      a {
        color: inherit;
        text-decoration: inherit;
      }

      input {
        padding: 2px 4px;
      }

      img {
        display: block;
      }

      html {
        scroll-behavior: smooth
      }
    </style>
    <style data-tag="default-style-sheet">
      html {
        font-family: Inter;
        font-size: 16px;
      }

      body {
        font-weight: 400;
        font-style: normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.15;
        color: var(--dl-color-gray-black);
        background-color: var(--dl-color-gray-white);

      }
    </style>
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      data-tag="font" />
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      data-tag="font" />
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&amp;display=swap"
      data-tag="font" />
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font" />
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
  <!-- Age verification script -->
  <script src="https://cdn.commoninja.com/sdk/latest/commonninja.js" defer></script>
  <div class="commonninja_component pid-811d568e-63fe-4690-a88a-df275a02a786"></div>

  <link rel="stylesheet" href="./style.css" />
  <div>
    <link href="./index.css" rel="stylesheet" />

    <div class="main-page-container">
      <div class="main-page-header">
        <header data-thq="thq-navbar" class="main-page-navbar-interactive">
          <a href="index.php" />
          <img alt="image" src="./images/MyEcigShopLogoNew.png" class="main-page-image" />
          </a>
          <nav class="main-page-links">
            <a href="index.php" class="main-page-nav1">Home</a>
            <a href="products.php" class="main-page-nav2">Products</a>
            <span class="main-page-nav3">Order</span>
            <a href="account.php" class="main-page-nav4">
              <span class="main-page-text">Cart</span>
              <br />
            </a>
            <span class="main-page-nav5"></span>
          </nav>
          <div class="main-page-container1">
            <div data-thq="thq-navbar-nav" class="main-page-desktop-menu"></div>
          </div>
          <div data-thq="thq-burger-menu" class="main-page-burger-menu">
            <svg viewBox="0 0 1024 1024" class="main-page-icon">
              <path
                d="M128 554.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667zM128 298.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667zM128 810.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667z">
              </path>
            </svg>
          </div>
        </header>
      </div>
      <div class="main-page-hero">
        <h1 class="main-page-text02">My E-cig shop Lakatamia</h1>
        <span class="main-page-text03">
          <br />
          <span>
            This is the official website for my e-cig shop in Lakatamia,
            Nicosia only
          </span>
        </span>
        <div class="main-page-btn-group">
          <a href="login-page.php" class="main-page-navlink button">
            <span>
              <span class="main-page-text07">Login</span>
              <br />
            </span>
          </a>
          <a href="register-page.php" class="main-page-navlink1 button">
            Sign Up
          </a>
        </div>
      </div>
      <div class="main-page-details">
        <div class="main-page-details1">
          <div class="main-page-container2">
            <span class="main-page-text09 sectionTitle">
              <span>Details</span>
              <br />
            </span>
            <h2 class="main-page-details-heading heading2">
              Convenient Online Ordering and In-Store Pickup
            </h2>
            <span class="main-page-details-sub-heading">
              Order your favorite products online and pick them up at our
              store at your convenience
            </span>
          </div>
          <img src="./images/steamTrain.png" class="main-page-details-image" />
        </div>
      </div>
      <div class="main-page-banner">
        <h1 class="main-page-banner-heading heading2">
          Explore our Online Store
        </h1>
        <span class="main-page-banner-sub-heading">
          Browse through our extensive collection of electronic cigarettes and
          accessories
        </span>
        <a href="products.php" class="main-page-banner-button button">
          Start Shopping
        </a>
      </div>
      <div class="main-page-features"></div>
      <div class="main-page-banner1"></div>
      <div class="main-page-faq"></div>
      <div class="main-page-footer">
        <footer class="main-page-footer1">
          <div class="main-page-container3">
            <span class="main-page-logo1">ECS</span>
            <nav class="main-page-nav1">
              <a href="index.php" class="main-page-nav12">Home</a>
              <a href="products.php" class="main-page-nav22">Products</a>
              <a href="cart-page.php" class="main-page-nav32">
                <span>Cart</span>
                <br />
              </a>
              <span class="main-page-nav42">Account</span>
              <a href="contact-us.php" class="main-page-nav52">Contact</a>
            </nav>
          </div>
          <div class="main-page-separator"></div>
          <div class="main-page-container4">
            <span class="main-page-text14">
              © 2023 my-ecigshop, All Rights Reserved.
            </span>

            <div class="Social Media Icons">
              <a href="https://twitter.com" target="_blank" rel="noreferrer noopener" class="main-page-link">
                <svg viewBox="0 0 950.8571428571428 1024" class="main-page-icon10">
                  <path
                    d="M925.714 233.143c-25.143 36.571-56.571 69.143-92.571 95.429 0.571 8 0.571 16 0.571 24 0 244-185.714 525.143-525.143 525.143-104.571 0-201.714-30.286-283.429-82.857 14.857 1.714 29.143 2.286 44.571 2.286 86.286 0 165.714-29.143 229.143-78.857-81.143-1.714-149.143-54.857-172.571-128 11.429 1.714 22.857 2.857 34.857 2.857 16.571 0 33.143-2.286 48.571-6.286-84.571-17.143-148-91.429-148-181.143v-2.286c24.571 13.714 53.143 22.286 83.429 23.429-49.714-33.143-82.286-89.714-82.286-153.714 0-34.286 9.143-65.714 25.143-93.143 90.857 112 227.429 185.143 380.571 193.143-2.857-13.714-4.571-28-4.571-42.286 0-101.714 82.286-184.571 184.571-184.571 53.143 0 101.143 22.286 134.857 58.286 41.714-8 81.714-23.429 117.143-44.571-13.714 42.857-42.857 78.857-81.143 101.714 37.143-4 73.143-14.286 106.286-28.571z">
                  </path>
                </svg>
              </a>
              <a href="https://instagram.com" target="_blank" rel="noreferrer noopener" class="main-page-link1">
                <svg viewBox="0 0 877.7142857142857 1024" class="main-page-icon12">
                  <path
                    d="M585.143 512c0-80.571-65.714-146.286-146.286-146.286s-146.286 65.714-146.286 146.286 65.714 146.286 146.286 146.286 146.286-65.714 146.286-146.286zM664 512c0 124.571-100.571 225.143-225.143 225.143s-225.143-100.571-225.143-225.143 100.571-225.143 225.143-225.143 225.143 100.571 225.143 225.143zM725.714 277.714c0 29.143-23.429 52.571-52.571 52.571s-52.571-23.429-52.571-52.571 23.429-52.571 52.571-52.571 52.571 23.429 52.571 52.571zM438.857 152c-64 0-201.143-5.143-258.857 17.714-20 8-34.857 17.714-50.286 33.143s-25.143 30.286-33.143 50.286c-22.857 57.714-17.714 194.857-17.714 258.857s-5.143 201.143 17.714 258.857c8 20 17.714 34.857 33.143 50.286s30.286 25.143 50.286 33.143c57.714 22.857 194.857 17.714 258.857 17.714s201.143 5.143 258.857-17.714c20-8 34.857-17.714 50.286-33.143s25.143-30.286 33.143-50.286c22.857-57.714 17.714-194.857 17.714-258.857s5.143-201.143-17.714-258.857c-8-20-17.714-34.857-33.143-50.286s-30.286-25.143-50.286-33.143c-57.714-22.857-194.857-17.714-258.857-17.714zM877.714 512c0 60.571 0.571 120.571-2.857 181.143-3.429 70.286-19.429 132.571-70.857 184s-113.714 67.429-184 70.857c-60.571 3.429-120.571 2.857-181.143 2.857s-120.571 0.571-181.143-2.857c-70.286-3.429-132.571-19.429-184-70.857s-67.429-113.714-70.857-184c-3.429-60.571-2.857-120.571-2.857-181.143s-0.571-120.571 2.857-181.143c3.429-70.286 19.429-132.571 70.857-184s113.714-67.429 184-70.857c60.571-3.429 120.571-2.857 181.143-2.857s120.571-0.571 181.143 2.857c70.286 3.429 132.571 19.429 184 70.857s67.429 113.714 70.857 184c3.429 60.571 2.857 120.571 2.857 181.143z">
                  </path>
                </svg>
              </a>
              <a href="https://facebook.com" target="_blank" rel="noreferrer noopener" class="main-page-link2">
                <svg viewBox="0 0 602.2582857142856 1024" class="main-page-icon14">
                  <path
                    d="M548 6.857v150.857h-89.714c-70.286 0-83.429 33.714-83.429 82.286v108h167.429l-22.286 169.143h-145.143v433.714h-174.857v-433.714h-145.714v-169.143h145.714v-124.571c0-144.571 88.571-223.429 217.714-223.429 61.714 0 114.857 4.571 130.286 6.857z">
                  </path>
                </svg>
              </a>
            </div>
          </div>
        </footer>
      </div>
      <div>
      </div>
    </div>
  </div>
</body>

</html>