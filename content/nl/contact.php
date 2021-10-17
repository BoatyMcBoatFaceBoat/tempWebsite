<?php session_start();
$rand_token = openssl_random_pseudo_bytes(16);
$token = bin2hex($rand_token);
//$_SESSION['token'] = $token;

$captcha =  array(
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
  array(
    'q' => 'Ork ork ork, soep een je met een ...?',
    'a' => array('lepel', 'spork')
  ),
  array(
    'q' => 'In de Peanuts-strip, hoe heet de hond?',
    'a' => array('Snoopy')
  ),
  array(
    'q' => 'De officiële taal van Frankrijk is ...?',
    'a' => array('Frans')
  ),
  array(
    'q' => 'Het kasteel van koning Arthur heet ...?',
    'a' => array('Camelot')
  )
);
$captchaIndex = rand(0, count($captcha) - 1);
$_SESSION[$token]['captcha_answer'] = $captcha[$captchaIndex]['a'];
?>
<div>
  <h1> Contact</h1>
  <div class="contact flowText">
    <form action="xyzzy.php" method="post">
      <!-- <input type="hidden" name="token" value="<?php echo $token; ?>" required="required" /> -->
      <?php echo '<input type="hidden" name="token" value="' . $token . '" required="required" />'; ?>
      <p>Uw naam <input type="text" name="name" required="required" /></p>
      <p>E-mailaddres <input type="email" name="email" required="required" /></p>
      <p>Onderwerp <input type="text" name="subject" required="required" /></p>
      <p>Uw bericht <textarea name="message" rows="8" cols="35" required="required"></textarea></p>
        <p><?php echo $captcha[$captchaIndex]['q']; ?> <input type="text" name="captcha" required="required" /></p>
      <p>
        <input type="submit" value="Verzend"/>
      </p>
    </form>
  </div>
</div>