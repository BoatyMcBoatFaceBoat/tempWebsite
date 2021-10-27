<?php session_start();
if (!empty($_POST['token']) && !empty($_SESSION[$_POST['token']])) {
  $success = false;
  if (!empty($_POST['captcha']) && !empty($_SESSION[$_POST['token']]['captcha_answer'])) {
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
  }
  session_destroy();

  if($success) {
      ?>
    <div class="contact">
        U hebt succesvol contact met ons opgenomen, dankuwel.
    </div>
    <?php
  } else {
    ?>
      <div class="contact">
          Er ging helaas iets mis, probeer het nog een keer.
      </div>
    <?php
  }
} else {
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
      'a' => array('2022')
    ),
    array(
      'q' => 'Welk jaar was het afgelopen jaar (yyyy)?',
      'a' => array('2020')
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
      'q' => 'De officiële taal van Frankrijk is ...?',
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
    <div class="contact">
        <div class="form">
            <h1>Contact</h1>
            <!-- <div class="contact flowText"> -->
            <form action="" method="post">
                <!-- <input type="hidden" name="token" value="<?php echo $token; ?>" required="required" /> -->
              <?php echo '<input type="hidden" name="token" value="' . $token . '" required="required" />'; ?>
                <p>Uw naam </p>
                <input type="text" name="name" required="required"/>
                <p>E-mailadres</p>
                <input type="email" name="email" required="required"/></p>
                <p>Onderwerp</p>
                <input type="text" name="subject" required="required"/></p>
                <p>Uw bericht</p>
                <textarea name="message" rows="8" cols="35" required="required"></textarea></p>
                <p><?php echo $captcha[$captchaIndex]['q']; ?></p>
                <input type="text" name="captcha" required="required"/>

                <input class="btn" type="submit" value="Verzend"/>
            </form>
        </div>
        <div class="extra">
            <p>Van den Heuvel HLT Consultancy handelt onder de naam <?php echo $company; ?>.</p>
            <p>Ons kantoor bevindt zich in Malden vlakbij Nijmegen, in het oude Gemeentehuis.</p>
            <p> Ons KvK-nummer is 09205757. Theo van den Heuvel is de eigenaar.</p>
            <p class="icon-p">
                <img class="icon" src="<?php
                if (strpos($_SERVER['REQUEST_URI'], 'tempWebsite') !== false) {
                  echo '/tempWebsite';
                }
                ?>/media/home_icon.png" alt="address">
                Rijksweg 112
            </p>
            <p class="icon-p">
                <img class="icon" src="<?php
                if (strpos($_SERVER['REQUEST_URI'], 'tempWebsite') !== false) {
                  echo '/tempWebsite';
                }
                ?>/media/telephone_icon.png" alt="address">

                +31625492788
            </p>

        </div>
    </div>
  <?php
}
?>