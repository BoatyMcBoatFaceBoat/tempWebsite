<?php
$lang = 'nl';
$page = 'home';
if(!empty($_GET['lang'])) {
  $lang = $_GET['lang'];
}
if(!empty($_GET['page'])) {
  $page = $_GET['page'];
}
$pages = json_decode(file_get_contents('pages.json'));
$languages = array(
  'nl',
  'en',
  'de'
);
$aboutPages = array(
  'values',
  'team',
  'contact',
  'impressum',
  'partners'
);

$menu = array(
  
);
?><html>

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
    <script src="<?php
        if(strpos($_SERVER['REQUEST_URI'], 'tempWebsite') !== false) {
          echo '/tempWebsite';
        }
      ?>/script/temp.js"></script>
</head>

<body onload="loadWebsite()">
  <header>
    <a href="/<?php
    if(strpos($_SERVER['REQUEST_URI'], 'tempWebsite') !== false) {
      echo 'tempWebsite/';
    }
    if(!empty($_GET['lang'])) {
      echo $lang;
    }
    ?>/"><img src="<?php
      if(strpos($_SERVER['REQUEST_URI'], 'tempWebsite') !== false) {
        echo '/tempWebsite';
      }
    ?>/media/logo.png" alt="logo" class="logo" /></a>
    <div class="nav-menu nav-wrapper">
    <nav class="nav">
      <ul>
        <?php
          foreach($pages as $pageName => $menuItem) {
            if(!in_array($pageName, $aboutPages)) {
              if(!empty($menuItem->lang->$lang)) {
              echo '<li><a href="' . $pageName . '"';
              if($page === $pageName) {
                echo ' class="active"';
              }
              echo '>' . $menuItem->lang->$lang . '</a></li>';
            }
            }
          }
        ?>
      </ul>
    </nav>
  </div>
  <div class="lang">
    <a class="lang-item lang-active">
      <img src="<?php
        if(strpos($_SERVER['REQUEST_URI'], 'tempWebsite') !== false) {
          echo '/tempWebsite';
        }
      ?>/media/flag_<?php echo $lang; ?>.png" />
    </a>
    <?php
    foreach ($languages as $language) {
      if($language != $lang) {
        ?>
        <a class="lang-item" href="<?php
          if(strpos($_SERVER['REQUEST_URI'], 'tempWebsite') !== false) {
            echo '/tempWebsite';
          }
          echo '/' . $language . '/';
        ?>">
          <img src="<?php
            if(strpos($_SERVER['REQUEST_URI'], 'tempWebsite') !== false) {
              echo '/tempWebsite';
            }
          ?>/media/flag_<?php echo $language; ?>.png" />
          </a>
        <?php
      }
    }
    ?>
  </div>
  </header>
  
  <div class="breadCrumb"><?php
      $breadcrumb = '<a href="' . $page . '">' . $pages->$page->lang->$lang . '</a>';
      $breadcrumbPage = $page;
      while($pages->$breadcrumbPage->parent != false) {
        $breadcrumbPage = $pages->$breadcrumbPage->parent;
        $breadcrumb = '<a href="' . $breadcrumbPage . '">' . $pages->$breadcrumbPage->lang->$lang . '</a> / ' . $breadcrumb;
      }
      echo $breadcrumb;
      ?></div>

  <div class="content-wrapper">
    <div class="content"><?php
  if(!empty($pages->$page)) {
    if(!empty($pages->$page->lang->$lang)) {
      // echo "Deze pagina is wel beschikbaar in uw taalversie.";
      include('content/' . $lang . '/' . $pages->$page->filename);
    } else {
      echo "Deze pagina is niet beschikbaar in uw taalversie.";
    }
  } else {
    echo "Deze pagina bestaat niet.";
  }
  ?></div>
  </div>

  <!-- <div class="nav-wrapper"> -->
  

  <div class="nav-wrapper">
    <nav class="nav">
      <ul>
        <?php
          foreach($aboutPages as $aboutPage) {
            echo '<li><a href="' . $aboutPage . '"';
            if($page === $aboutPage) {
              echo ' class="active"';
            }
            echo '>' . $pages->$aboutPage->lang->$lang . '</a></li>';
          }
        ?>
      </ul>
      <p>this website was made by vandenHeuvelHLT Consultancy</p>
    </nav>
  </div>

</body>

</html>