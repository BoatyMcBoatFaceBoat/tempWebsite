<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Untangle </title>
  <link rel="stylesheet" href="<?php
      if(strpos($_SERVER['REQUEST_URI'], 'tempWebsite') !== false) {
        echo '/tempWebsite';
      }
    ?>/styles/style.css">
  <script src="<?php
      if(strpos($_SERVER['REQUEST_URI'], 'tempWebsite') !== false) {
        echo '/tempWebsite';
      }
    ?>/script/untangle.js"></script>
</head>
sudo mysqld_safe --skip-grant-tables

<body>
  <header>
    <a href="#home"><img src="<?php
      if(strpos($_SERVER['REQUEST_URI'], 'tempWebsite') !== false) {
        echo '/tempWebsite';
      }
    ?>/media/logo.png" alt="logo" class="logo"></a>
  </header>

  <div class="content-wrapper"><?php
  $lang = 'nl';
  $page = 'home';
  if(!empty($_GET['lang'])) {
    $lang = $_GET['lang'];
  }
  if(!empty($_GET['page'])) {
    $page = $_GET['page'];
  }
  $pages = json_decode(file_get_contents('pages.json'));
  include('content/' . $lang . '/' . $pages->$lang->$page);
  ?>
  </div>

  <div class="nav-wrapper">
    <div class="breadCrumb">
  </div>
  <div class="nav-wrapper">
    <nav class="nav">
      <ul>
        <li><a href="values"> values </a></li>
        <li><a href="team"> team </a></li>
        <li><a href="contact"> contact </a></li>
        <li><a href="impressum"> impressum </a></li>
        <li><a href="partners"> partners </a></li>
      </ul>
      <p>this website was made by vandenHeuvelHLT Consultancy</p>
    </nav>
  </div>

</body>

</html>