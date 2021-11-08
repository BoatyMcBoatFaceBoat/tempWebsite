<?php
$company = "Untangle Logic";
$langDefault = 'nl';
$prefix = '';
if (strpos($_SERVER['REQUEST_URI'], 'tempWebsite')) {
  $prefix = '/tempWebsite';
}
$prefixLang = $prefix;
$page = 'home';
if (!empty($_GET['lang'])) {
  if($_GET['lang'] === $langDefault) {
    header('Location: ' . $prefix . '/' . (!empty($_GET['page']) ? $_GET['page'] : ''));
  }
  $lang = $_GET['lang'];
  $prefixLang .= '/' . $lang;
} else {
  $lang = $langDefault;
}
if (!empty($_GET['page'])) {
  $page = $_GET['page'];
}
$pages = json_decode(file_get_contents('pages.json'));
$languages = array(
  'nl',
  'en'
);
$aboutPages = array(
  'values',
  'team',
  'contact',
  'impressum',
  'partners'
);
$menuPages = array(
  'spreadsheet',
  array('consultancy' => array('model', 'language')),
  array('software' => array('electron', 'raku'))
);

$misspage = '';
if (!empty($pages->$page)) {
  if (!empty($pages->$page->lang->$lang)) {
    $currentPageData = $pages->$page;
    $currentPage = $currentPageData->lang->$lang;
    $currentPageFile = 'content/' . $lang . '/' . $currentPageData->filename;
  } else {
    switch ($lang) {
      case "nl":
        $misspage = 'Deze pagina bestaat niet in uw taal.';
        break;
      case "en":
        $misspage = 'This page does not exist in your language.';
        break;
    }
  }
} else {
  switch ($lang) {
    case "nl":
      $misspage = 'Deze pagina bestaat niet.';
      break;
    case "en":
      $misspage = 'This page does not exist.';
      break;
  }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="google-site-verification" content="+nxGUDJ4QpAZ5l9Bsjdi102tLVC21AIh5d1Nl23908vVuFHs34="/> -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $prefix ?>/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $prefix ?>/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $prefix ?>/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title><?php
    if (!empty($_GET['page'])) {
      if (!empty($currentPageFile)) {
        echo $currentPage->title . ' | ';
      } else {
        switch ($lang) {
          case "nl":
            echo 'Pagina niet gevonden |';
            break;
          case "en":
            echo 'Page not found |';
            break;
        }
      }
    }
    echo $company;
    ?></title>
      <?php
      if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   {
        $url = "https://";   
      } else {
        $url = "http://";
      }
      $url.= $_SERVER['HTTP_HOST'];   
      foreach ($languages as $language) {
        if ($language != $lang) {
          if(!empty($currentPageFile)) {
            echo '<link rel="alternate" hreflang="' . $language . '" href="';
            echo $url . $prefix . '/';
            if($language !== $langDefault) {
              echo $language . '/' ;
            }
            if(!empty($_GET['page'])) {
              echo $page;
            }
            echo '">';
          }
        }
      }
      echo '<meta name="description" content="' . $currentPage->description . '">';
      ?>
    <!-- <link rel="alternate" hreflang="en" href="https://heuvelhlt.nl/en/consultancy" /> -->
    <link rel="stylesheet" href="<?php echo $prefix ?>/styles/style.css">
    <script src="<?php echo $prefix ?>/script/untangle.js"></script>
    <script src="<?php echo $prefix ?>/script/temp.js"></script>
</head>

<body onload="loadWebsite()">
<header>
    <a href="<?php echo $prefixLang;?>/">
      <div class="logo-wrapper"><?php include("media/untangle_logic_logo_double.svg"); ?></div>
    </a>

    <div class="header-menu-icon">
      <span class="hamburger">
        <span class="top"></span>
        <span class="middle"></span>
        <span class="bottom"></span>
      </span>
    </div>
    <div class="header-menu">
        <nav class="header-menu-nav">
            <ul>
              <?php
              foreach ($menuPages as $menuPage) {
                $menuPageArray = '';
                $openTrigger = '';
                if (is_array($menuPage)) {
                  $menuPageKey = array_keys($menuPage)[0];
                  $menuPageArray = $menuPage[$menuPageKey];
                  $menuPage = $menuPageKey;
                  $openTrigger = ' <span class="trigger-open"></span>';
                }
                if (!empty($pages->$menuPage->lang->$lang->title)) {
                  echo '<li';
                  if ($page === $menuPage || !empty($openTrigger)) {
                    echo ' class="';
                    if ($page === $menuPage) {
                      echo 'active ';
                    }
                    if (!empty($openTrigger)) {
                      echo ' trigger-openable ';
                    }
                    echo '"';
                  }
                  echo '><a href="' . $prefixLang . '/' . $menuPage . '">' . $pages->$menuPage->lang->$lang->title . $openTrigger . '</a>';
                  if (!empty($menuPageArray)) {
                    echo '<ul>';
                    foreach ($menuPageArray as $subMenuPage) {
                      echo '<li';
                      if ($page === $subMenuPage) {
                        echo ' class="active"';
                      }
                      echo '><a href="' . $prefixLang . '/' . $subMenuPage . '">' . $pages->$subMenuPage->lang->$lang->title . '</a>';
                    }
                    echo '</ul>';
                  }
                  echo '</li>';
                }
              }
              ?>
            </ul>
        </nav>
    </div>
    <div class="lang">
        <a class="lang-item lang-active trigger-open">
            <img class="flag" src="<?php echo $prefix ?>/media/flag_<?php echo $lang; ?>.png" alt="<?php echo $lang;?>_flag_icon"/>
        </a>
      <?php
      foreach ($languages as $language) {
        if ($language != $lang) {
          ?>
            <a class="lang-item" href="<?php
            echo $prefix . '/';
            if($language !== $langDefault) {
              echo $language . '/' ;
            }
            if(!empty($currentPageFile)) {
              echo $page;
            }
            ?>">
                <img src="<?php echo $prefix ?>/media/flag_<?php echo $language; ?>.png"/>
            </a>
          <?php
        }
      }
      ?>
    </div>
</header>

<div class="breadCrumb"><?php
  if(!empty($currentPageFile)) {
    $breadcrumb = '<a href="' . $prefixLang . '/' . $page . '">' . $currentPage->title . '</a>';
    $breadcrumbPage = $page;
    while ($pages->$breadcrumbPage->parent != false) {
      $breadcrumbPage = $pages->$breadcrumbPage->parent;
      $breadcrumb = '<a href="' . $prefixLang . '/' . $breadcrumbPage . '">' . $pages->$breadcrumbPage->lang->$lang->title . '</a> / ' . $breadcrumb;
    }
    echo $breadcrumb;
  } else {
    switch ($lang) {
      case "nl":
        $notFound = 'Pagina niet gevonden';
        break;
      case "en":
        default:
        $notFound = 'Page not found';
        break;
    }
    echo '<a href="' . $prefixLang . '/">Home</a> / ' . $notFound;
  }
  ?>
</div>

<div class="content-wrapper">
    <div class="content"><?php
    if(!empty($currentPageFile)) {
      include($currentPageFile);
    } else {
      echo $misspage;
    }
    if (!empty($currentPageFile) && $page != 'contact') {
        ?>
          <div class="contact-element click-target">
            <div class="envelope-wrapper click-target">
              <?php include('media/envelope_closed.svg')?>
              <?php include('media/envelope_open_letter.svg')?>
            </div>

            <?php
            $linktext = '';

            switch ($lang) {
              case "nl":
                $linktext = 'neem contact met ons op';
                break;
              case "en":
                default:
                $linktext = 'contact us';
                break;
            }
            echo '<a href="' . $prefixLang . '/contact">' . $linktext . '</a>';
            ?>

          </div>
        <?php
      }
      ?>


    </div>
</div>

<!-- <div class="nav-wrapper"> -->


<footer class="nav-wrapper footer">
    <nav class="nav">
        <ul>
          <?php
          foreach ($aboutPages as $aboutPage) {
            echo '<li><a href="' . $prefixLang . '/' .$aboutPage . '"';
            if ($page === $aboutPage) {
              echo ' class="active"';
            }
            echo '>' . $pages->$aboutPage->lang->$lang->title . '</a></li>';
          }
          ?>
        </ul>
    </nav>
    <p>this&nbsp;website&nbsp;was&nbsp;made&nbsp;by&nbsp;Van&nbsp;den&nbsp;Heuvel&nbsp;HLT&nbsp;Consultancy</p>
</footer>

</body>

</html>