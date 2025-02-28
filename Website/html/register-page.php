<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect input data
    $phone = $_POST['phone'];
    $firstname = $_POST['firstname'];
    $birthdate = $_POST['birthdate'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Database connection
   // Set session variables
   $serverName = $_SESSION["serverName"];
   $connectionOptions = $_SESSION["connectionOptions"];
     $conn = sqlsrv_connect($serverName, $connectionOptions);

     if($conn === false) {
       die(print_r(sqlsrv_errors(), true));
   }

    // Prepare SQL statement
    $tsql = "{call spSIGNUP (?, ?, ?, ?, ?, ?, ?)}";
    $params = array($email, $phone, $firstname, $lastname, $username, $password, $birthdate);

    // Execute the query
      $stmt = sqlsrv_query($conn, $tsql, $params);
    if ($stmt === false) {
      echo "Error Registering.";
      print_r(sqlsrv_errors(), true);
    } else {
        echo "Registration successful.";
        /* Free query  resources. */
    sqlsrv_free_stmt($stmt);
    }
    // Close the connection
    sqlsrv_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>RegisterPage - my-ecigshop</title>
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
</head>

<body>
  <link rel="stylesheet" href="./style.css" />
  <div>
    <link href="./register-page.css" rel="stylesheet" />

    <div class="register-page-container">
      <a href="index.php" class="register-page-navlink">
        <img alt="image" src="https://my-ecigshop.com/wp-content/uploads/2021/03/MyEcigShopLogoNew.png"
          class="register-page-ecig-picture" />
      </a>
      <header class="register-page-backround">
      <form action="register-page.php" method="post"> 
        <input type="tel" name="phone" placeholder="phone" class="register-page-username-member input" />
        <input type="text" name="firstname" placeholder="Firstname" class="register-page-username-member1 input" />
        <input type="date" name="birthdate" placeholder="Age" class="register-page-username-admin input" />
        <input type="text" name="lastname" placeholder="Lastname" class="register-page-username-admin1 input" />
        <input type="password" name="password" placeholder="password" class="register-page-password-admin input" />
        <input type="email" name="email" placeholder="email" class="register-page-password-member input" />
        <input type="text" name="username" placeholder="username" class="register-page-password-member1 input" />
        
        <button type="submit" class="register-page-member-login button">
        <span class="register-page-text">
            <span class="register-page-text1">Register</span>
        </span>
    </button>

        </form>

        <a href="login-page.php" class="register-page-sign-up-button">
          I am already a member
        </a>
        <img alt="image" src="./images/vape-img2.png" class="register-page-image" />
        <span class="register-page-text5">Age</span>
      </header>
      <div class="register-page-footer">
        <footer class="register-page-footer1">
          <div class="register-page-container1">
            <span class="register-page-logo">ECS</span>
            <a href="index.php" class="register-page-navlink1">
              <nav class="register-page-nav">
                <span class="register-page-nav1">Home</span>
                <span class="register-page-nav2">Products</span>
                <span class="register-page-nav3">
                  <span>Cart</span>
                  <br />
                </span>
                <span class="register-page-nav4">Account</span>
                <span class="register-page-nav5">Contact</span>
              </nav>
            </a>
          </div>
          <div class="register-page-separator"></div>
          <div class="register-page-container2">
            <span class="register-page-text8">
              © 2023 E-cig shop, All Rights Reserved.
            </span>
            <div class="register-page-icon-group">
              <a href="https://twitter.com" target="_blank" rel="noreferrer noopener" class="register-page-link">
                <svg viewBox="0 0 950.8571428571428 1024" class="register-page-icon">
                  <path
                    d="M925.714 233.143c-25.143 36.571-56.571 69.143-92.571 95.429 0.571 8 0.571 16 0.571 24 0 244-185.714 525.143-525.143 525.143-104.571 0-201.714-30.286-283.429-82.857 14.857 1.714 29.143 2.286 44.571 2.286 86.286 0 165.714-29.143 229.143-78.857-81.143-1.714-149.143-54.857-172.571-128 11.429 1.714 22.857 2.857 34.857 2.857 16.571 0 33.143-2.286 48.571-6.286-84.571-17.143-148-91.429-148-181.143v-2.286c24.571 13.714 53.143 22.286 83.429 23.429-49.714-33.143-82.286-89.714-82.286-153.714 0-34.286 9.143-65.714 25.143-93.143 90.857 112 227.429 185.143 380.571 193.143-2.857-13.714-4.571-28-4.571-42.286 0-101.714 82.286-184.571 184.571-184.571 53.143 0 101.143 22.286 134.857 58.286 41.714-8 81.714-23.429 117.143-44.571-13.714 42.857-42.857 78.857-81.143 101.714 37.143-4 73.143-14.286 106.286-28.571z">
                  </path>
                </svg>
              </a>
              <a href="https://instagram.com" target="_blank" rel="noreferrer noopener" class="register-page-link1">
                <svg viewBox="0 0 877.7142857142857 1024" class="register-page-icon2">
                  <path
                    d="M585.143 512c0-80.571-65.714-146.286-146.286-146.286s-146.286 65.714-146.286 146.286 65.714 146.286 146.286 146.286 146.286-65.714 146.286-146.286zM664 512c0 124.571-100.571 225.143-225.143 225.143s-225.143-100.571-225.143-225.143 100.571-225.143 225.143-225.143 225.143 100.571 225.143 225.143zM725.714 277.714c0 29.143-23.429 52.571-52.571 52.571s-52.571-23.429-52.571-52.571 23.429-52.571 52.571-52.571 52.571 23.429 52.571 52.571zM438.857 152c-64 0-201.143-5.143-258.857 17.714-20 8-34.857 17.714-50.286 33.143s-25.143 30.286-33.143 50.286c-22.857 57.714-17.714 194.857-17.714 258.857s-5.143 201.143 17.714 258.857c8 20 17.714 34.857 33.143 50.286s30.286 25.143 50.286 33.143c57.714 22.857 194.857 17.714 258.857 17.714s201.143 5.143 258.857-17.714c20-8 34.857-17.714 50.286-33.143s25.143-30.286 33.143-50.286c22.857-57.714 17.714-194.857 17.714-258.857s5.143-201.143-17.714-258.857c-8-20-17.714-34.857-33.143-50.286s-30.286-25.143-50.286-33.143c-57.714-22.857-194.857-17.714-258.857-17.714zM877.714 512c0 60.571 0.571 120.571-2.857 181.143-3.429 70.286-19.429 132.571-70.857 184s-113.714 67.429-184 70.857c-60.571 3.429-120.571 2.857-181.143 2.857s-120.571 0.571-181.143-2.857c-70.286-3.429-132.571-19.429-184-70.857s-67.429-113.714-70.857-184c-3.429-60.571-2.857-120.571-2.857-181.143s-0.571-120.571 2.857-181.143c3.429-70.286 19.429-132.571 70.857-184s113.714-67.429 184-70.857c60.571-3.429 120.571-2.857 181.143-2.857s120.571-0.571 181.143 2.857c70.286 3.429 132.571 19.429 184 70.857s67.429 113.714 70.857 184c3.429 60.571 2.857 120.571 2.857 181.143z">
                  </path>
                </svg>
              </a>
              <a href="https://facebook.com" target="_blank" rel="noreferrer noopener" class="register-page-link2">
                <svg viewBox="0 0 602.2582857142856 1024" class="register-page-icon4">
                  <path
                    d="M548 6.857v150.857h-89.714c-70.286 0-83.429 33.714-83.429 82.286v108h167.429l-22.286 169.143h-145.143v433.714h-174.857v-433.714h-145.714v-169.143h145.714v-124.571c0-144.571 88.571-223.429 217.714-223.429 61.714 0 114.857 4.571 130.286 6.857z">
                  </path>
                </svg>
              </a>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>
</body>

</html>