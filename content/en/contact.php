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
    'q' => 'Wil je koffie?',
    'a' => array('ja')
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
    'q' => 'Epel epel epel, vlees snij je met een ...?',
    'a' => array('mes')
  ),
  array(
    'q' => 'Welke kleuren heeft een ei?',
    'a' => array('wit en geel', 'geel en wit', 'wit & geel', 'geel & wit', 'wit geel', 'wit, geel')
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
      <p>Enter your name <input type="text" name="name" required="required" /></p>
      <p>E-mail address <input type="email" name="email" required="required" /></p>
      <p>Subject <input type="text" name="subject" required="required" /></p>
      <p>Enter your message <textarea name="message" rows="8" cols="35" required="required"></textarea></p>
        <p><?php echo $captcha[$captchaIndex]['q']; ?> <input type="text" name="captcha" required="required" /></p>
      <p>
        <input type="submit" value="Send"/>
      </p>
    </form>
  </div>
</div>