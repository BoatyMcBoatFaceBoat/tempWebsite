<div class="contact">
  <?php session_start();
  $success = false;
if (!empty($_POST['token'])) {
  if (!empty($_SESSION[$_POST['token']]) && !empty($_POST['captcha']) && !empty($_SESSION[$_POST['token']]['captcha_answer'])) {
    $captcha = $_POST['captcha'];
    $captcha = strtolower($captcha);
    $captcha = str_replace('de ', '', $captcha);
    $captcha = str_replace('het ', '', $captcha);
//  $captcha = str_replace('een ', '', $captcha);
    if (in_array($captcha, $_SESSION[$_POST['token']]['captcha_answer'])) {
      $sent = mail($_SERVER['SERVER_ADMIN'],
        ':>hlt: ' . htmlspecialchars($_POST['subject']),
        htmlspecialchars(str_replace("\n.", "\n..", $_POST['message'])),
        'From: ' . htmlspecialchars($_POST['email']) . "\r\n" .
        'X-Mailer: PHP/' . phpversion());
      $success = true;
    }
    if ($success) {
      ?>
            Dank u. We hebben uw bericht ontvangen 
            en zullen zo spoedig mogelijk reageren.
      <?php
      session_destroy();
    } else {
      $error = 'De beveiligingsvraag is helaas niet goed ingevuld.';
    }
  }
}
if(!$success) {
  $rand_token = openssl_random_pseudo_bytes(16);
  $token = bin2hex($rand_token);
//$_SESSION['token'] = $token;

  $captcha = array(
    array(
      'q' => 'Hoeveel oren heeft een konijn?',
      'a' => array('2', 'twee')
    ),
    array(
      'q' => 'Welke kleur buiten blauw en wit vindt je in de Nederlandse vlag?',
      'a' => array('rood')
    ),
    array(
      'q' => 'Welk jaar is het volgend jaar (yyyy)?',
      'a' => array(date('Y') + 1)
    ),
    array(
      'q' => 'Welk jaar was het afgelopen jaar (yyyy)?',
      'a' => array(date('Y') - 1)
    ),
    array(
      'q' => 'Welk dier verstopt met pasen eieren?',
      'a' => array('haas', 'paashaas')
    ),
    // array(
    //   'q' => 'Ork ork ork, soep een je met een ...?',
    //   'a' => array('lepel', 'spork')
    // ),
    array(
      'q' => 'In de Peanuts-strip, hoe heet de hond?',
      'a' => array('snoopy')
    ),
    array(
      'q' => 'De offici??le taal van Frankrijk is ...?',
      'a' => array('frans')
    ),
    array(
      'q' => 'Het kasteel van koning Arthur heet ...?',
      'a' => array('camelot')
    )
  );
  $captchaIndex = rand(0, count($captcha) - 1);
  $_SESSION[$token]['captcha_answer'] = $captcha[$captchaIndex]['a'];

// contact.php
// TvdH. July 2010
// no direct access
// defined('_HLT') or die('Access denied');
  ?>
  <div class="form">
    <h1>Contact</h1>
    <!-- <div class="contact flowText"> -->
    <form action="" method="post">
        <!-- <input type="hidden" name="token" value="<?php echo $token; ?>" required="required" /> -->
      <?php echo '<input type="hidden" name="token" value="' . $token . '" required="required" />'; ?>
        <p>Uw naam </p>
        <input type="text" name="name" required="required" value="<?php
        if(!empty($_POST['name'])) {
          echo $_POST['name'];
        }
        ?>"/>
        <p>E-mailadres</p>
        <input type="email" name="email" required="required" value="<?php
        if(!empty($_POST['email'])) {
          echo $_POST['email'];
        }
        ?>"/>
        <p>Onderwerp</p>
        <input type="text" name="subject" required="required" value="<?php
        if(!empty($_POST['subject'])) {
          echo $_POST['subject'];
        }
        ?>"/>
        <p>Uw bericht</p>
        <textarea name="message" rows="8" cols="35" required="required"><?php
        if(!empty($_POST['message'])) {
          echo $_POST['message'];
        }
        ?></textarea>
        <p><?php echo $captcha[$captchaIndex]['q']; ?></p>
        <input type="text" name="captcha" required="required" 
          placeholder="om te zien of u geen robot bent" <?php if(!empty($error)) {
        echo 'class= "error" ';
      } 
      ?>/>
      <?php if(!empty($error)) {
        echo '<p class="error">' . $error . '</p>';
      } 
      ?>

        <input class="btn" type="submit" value="Verzend"/>
    </form>
  </div>
  <div class="extra">
    <!-- <p>Van den Heuvel HLT Consultancy handelt onder de naam <?php echo $company; ?>.</p>
    <p>Ons kantoor bevindt zich in Malden vlakbij Nijmegen, in het oude Gemeentehuis.</p>
    <p> Ons KvK-nummer is 09205757. Theo van den Heuvel is de eigenaar.</p> -->
    <p class="icon-p">
      <img class="icon" src="<?php echo $prefix ?>/media/home_icon.png" alt="huis symbool">
              Rijksweg 112, 
      6581 ER Malden
    </p>
    <a href="tel:+31625492788">
        <img class="icon" src="<?php echo $prefix ?>/media/telephone_icon.png" alt="telefoon symbool">
        +31625492788
    </a>
  </div>
  <?php
}
?>
</div>